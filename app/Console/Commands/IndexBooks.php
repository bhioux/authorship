<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book;
use App\Services\ElasticsearchService;

class IndexBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index books to Elasticsearch';

    protected $elasticsearch;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ElasticsearchService $elasticsearch)
    {
        parent::__construct();
        $this->elasticsearch = $elasticsearch;
    }

    public function ensureIndexExists($index, $mappings = [])
    {
        if (!$this->elasticsearch->getClient()->indices()->exists(['index' => $index])) {
            $this->elasticsearch->getClient()->indices()->create([
                'index' => $index,
                'body' => [
                    'settings' => [
                        'number_of_shards' => 1,
                        'number_of_replicas' => 1,
                    ],
                    'mappings' => $mappings,
                ],
            ]);
        }
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $books = Book::all();
        $index = "books";

        $this->ensureIndexExists($index, [
            'properties' => [
                'title' => ['type' => 'text'],
                'description' => ['type' => 'text'],
                'author_id' => ['type' => 'integer'],
            ],
        ]);

        //'title', 'description', 'author_id'

        foreach ($books as $book) {
            $this->elasticsearch->getClient()->index([
                'index' => $index,
                'id'    => $book->id,
                'body'  => $book->toArray(),
            ]);
        }
        $this->info('Books indexed successfully!');
    }
}

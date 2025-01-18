<?php
namespace App\Services;

use Elasticsearch\ClientBuilder;
//use Elastic\Elasticsearch\ClientBuilder;

class ElasticsearchService
{
    protected $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()
            ->setHosts([getenv("ELASTICSEARCH_HOST")])
            ->build();
        
        // $this->client = ClientBuilder::create()
        //     ->setElasticCloudId(getenv("ELASTICSEARCH_HOST"))
        //     ->setApiKey('<id>', '<key>')
        //     ->build();
    }

    public function getClient()
    {
        return $this->client;
    }
}
<?php

namespace Tests\Unit;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_create_book()
    {
        // $this->assertTrue(true);
        $book = Book::Factory()->create();

        $this->assertInstanceOf(Book::class,$book);
        $this->assertDatabaseHas('books', ["author_id" => 4]);
    }

    /**@test */
    public function test_can_delete_book(){
        $book = Book::factory()->create();

        $this->assertTrue($book->delete());
        $this->assertDeleted($book);
    }
}

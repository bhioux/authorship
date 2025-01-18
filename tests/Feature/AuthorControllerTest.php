<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;

class AuthorControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function test_that_record_is_loaded()
    {
        $response = $this->get('/authors');
        // $mock = Mockery::mock(\App\Models\Author::class);
        // $authors = \App\Models\Author::all();
        // $view = $this->view('authors.index', compact('authors'));
        $response->assertStatus(200);
        // $view->assertSeeText('view');
    }
}

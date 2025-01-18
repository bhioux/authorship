<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestAuthorController extends TestCase
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
        $response->assertStatus(200);
        $response->assertSeeText('View');
    }
}

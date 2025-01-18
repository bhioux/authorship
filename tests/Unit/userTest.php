<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class userTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_user()
    {
        $user = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
        ];
        //$userData = User::factory()->create();

        $user = User::create($user);
        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }

    public function test_can_delete_user()
    {
        $user = User::factory()->create();

        $this->assertTrue($user->delete());
        $this->assertDeleted($user);
    }
}

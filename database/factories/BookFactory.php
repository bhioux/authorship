<?php

namespace Database\Factories;
use App\Models\Book;
use App\Models\Author;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
//use Faker\Generator as Faker;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $faker = Faker::create();
        // $author = Author::factory();
        return
         [            
            //"id" => Book::create(),
            "title" => $this->faker->sentence,
            "description" =>$this->faker->paragraph,
            "author_id" => Author::factory()
        ];
    }
}

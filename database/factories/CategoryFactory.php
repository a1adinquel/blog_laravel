<?php

namespace Database\Factories;


use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word
        ];
    }
}

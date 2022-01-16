<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->title(),
            'slug'=>$this->faker->unique()->slug(),
            'parent_id'=>random_int(0,6),
        ];
    }
}

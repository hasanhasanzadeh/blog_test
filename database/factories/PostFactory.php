<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->title(),
            'slug'=>$this->faker->unique()->slug(),
            'description'=>$this->faker->text(200),
            'photo_url'=>'https://static.roocket.ir/public/images/2019/10/22/laravel-2.png',
            'user_id'=>random_int(1,6),
            'category_id'=>random_int(1,5),
        ];
    }
}

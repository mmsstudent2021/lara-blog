<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        $description = $this->faker->realText(2000);
        return [
            "title"=> $title,
            "slug"=> Str::slug($title),
            "description"=>$description,
            "excerpt"=> Str::words($description,50," ....."),
            "user_id"=> User::inRandomOrder()->first()->id,
//            "user_id"=> rand(1,11),
            "category_id"=> Category::inRandomOrder()->first()->id,
//            "category_id"=> rand(1,4),
        ];
    }
}

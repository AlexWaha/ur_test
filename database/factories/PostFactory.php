<?php
// *	@copyright (c) OCDEV.PRO 2020 - 2022.
// * 	@author 	   Alexander Vakhovskiy (AlexWaha)
// *	@link 		   https://ocdev.pro
// *    @email 		   support@ocdev.pro
// *	@license	   see LICENSE.txt

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'title' => $this->faker->title,
            'description' => $this->faker->text(500),
            'is_active' => $this->faker->boolean,
        ];
    }
}
<?php

namespace Database\Factories;

use Error;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $idsCategoria = DB::table('categories')->pluck('id');
        //error_log("los ids son".$idsCategoria);
        return [
            'name' => fake()->name(),
            'stock' => rand(0, 100),
            'price' => rand(0, 100),
            'description' => fake()->realText(),
            'id_category' => fake()-> randomElement($idsCategoria),
        ];
    }


}

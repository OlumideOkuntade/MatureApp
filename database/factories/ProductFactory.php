<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Facade\Ignition\Support\FakeComposer;
use Faker\Guesser\Name;
use Illuminate\Database\Eloquent\Factories\Factory;
class ProductFactory extends Factory
{
    protected $model = Product::class; 
    /**
     * 
     * 
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
    }
}

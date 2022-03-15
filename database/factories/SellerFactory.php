<?php

namespace Database\Factories;

use App\Models\Seller\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;
use \Illuminate\Database\Eloquent\Factories\HasFactory;

class SellerFactory extends Factory
{
    protected $model = Seller::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
        ];
    }
}

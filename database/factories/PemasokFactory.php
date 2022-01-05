<?php

namespace Database\Factories;

use App\Models\Pemasok;
use Illuminate\Database\Eloquent\Factories\Factory;

class PemasokFactory extends Factory
{

    protected $model = Pemasok::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->streetAddress(),
            'telephone' => '0888888888'
        ];
    }
}

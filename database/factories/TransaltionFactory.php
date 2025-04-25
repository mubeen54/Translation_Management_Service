<?php

namespace Database\Factories;

use App\Models\Transaltion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaltion>
 */
class TransaltionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Transaltion::class;

    public function definition(): array
    {
        return [
            'locale' => $this->faker->randomElement(['en', 'fr', 'es']),
            'key' => $this->faker->word(),
            'value' => $this->faker->sentence(),
            'tags' => [$this->faker->randomElement(['web', 'mobile', 'desktop'])],
        ];
    }
}

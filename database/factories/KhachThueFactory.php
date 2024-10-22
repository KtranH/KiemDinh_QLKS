<?php

namespace Database\Factories;

use App\Models\KhachThue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KhachThue>
 */
class KhachThueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
        protected $model = KhachThue::class;
     public function definition(): array
    {
        return [
            'TenKhachHang' => $this->faker->name,
            'CMND' => $this->faker->unique()->numerify('#########'),
            'SDT' => $this->faker->numerify('0#########'),
        ];
    }
}

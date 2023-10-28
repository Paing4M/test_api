<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory {
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */

  public function definition(): array {
    $name = fake()->name;
    return [
      'name' => $name,
      'slug' => Str::slug($name),
      'description' => fake()->text(),
      'price' => fake()->numberBetween(200, 30000)
    ];
  }
}

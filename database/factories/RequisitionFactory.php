<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Requisition>
 */
class RequisitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $category = Category::inRandomOrder()->first();
        $subcategory = Subcategory::where('category_id', $category->id)->inRandomOrder()->first();

        return [
            'user_id' => $user->id, 'category_id' => $category->id,
            'subcategory_id' => $subcategory ? $subcategory->id : null,
            'item_name' => fake()->word(), 'notes' => fake()->sentence(),
        ];
    }
}

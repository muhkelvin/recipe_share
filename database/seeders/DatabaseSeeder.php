<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\RecipeCollection;
use App\Models\RecipeComment;
use App\Models\RecipeRating;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users
        User::factory()->count(10)->create()->each(function ($user) {
            // Create recipes
            $recipes = Recipe::factory()->count(5)->create(['user_id' => $user->id]);

            // Create ratings
            foreach ($recipes as $recipe) {
                RecipeRating::factory()->count(3)->create(['recipe_id' => $recipe->id, 'user_id' => $user->id]);
            }

            // Create comments
            foreach ($recipes as $recipe) {
                RecipeComment::factory()->count(3)->create(['recipe_id' => $recipe->id, 'user_id' => $user->id]);
            }

            // Create collections
            $collections = RecipeCollection::factory()->count(2)->create(['user_id' => $user->id]);

            // Add recipes to collections
            foreach ($collections as $collection) {
                $collection->recipes()->attach($recipes->random(3)->pluck('id')->toArray());
            }
        });
    }
}

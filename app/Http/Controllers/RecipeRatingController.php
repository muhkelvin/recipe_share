<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeRatingController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        RecipeRating::create([
            'recipe_id' => $recipe->id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->route('recipes.show', $recipe)->with('success', 'Rating submitted successfully.');
    }
}

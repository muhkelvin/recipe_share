<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeCommentController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        RecipeComment::create([
            'recipe_id' => $recipe->id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return redirect()->route('recipes.show', $recipe)->with('success', 'Comment submitted successfully.');
    }
}

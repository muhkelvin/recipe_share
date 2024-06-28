<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $recipe = new Recipe([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'instructions' => $request->instructions,
        ]);

        if ($request->hasFile('image')) {
            $recipe->image = $request->file('image')->store('images', 'public');
        }

        $recipe->save();

        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully.');
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->ingredients = $request->ingredients;
        $recipe->instructions = $request->instructions;

        if ($request->hasFile('image')) {
            $recipe->image = $request->file('image')->store('images', 'public');
        }

        $recipe->save();

        return redirect()->route('recipes.index')->with('success', 'Recipe updated successfully.');
    }

    public function addToCollection(Request $request, Recipe $recipe)
    {
        $request->validate([
            'collection_id' => 'required|exists:collections,id',
        ]);

        $collection = RecipeCollection::findOrFail($request->collection_id);

        if ($collection->recipes->contains($recipe->id)) {
            return redirect()->back()->withErrors(['Recipe is already in this collection.']);
        }

        $collection->recipes()->attach($recipe);

        return redirect()->back()->with('success', 'Recipe added to collection successfully.');
    }


    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully.');
    }


}

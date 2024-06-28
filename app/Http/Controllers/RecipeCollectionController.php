<?php

namespace App\Http\Controllers;

use App\Models\RecipeCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeCollectionController extends Controller
{
    public function index()
    {
        $collections = RecipeCollection::where('user_id', Auth::id())->get();
        return view('collections.index', compact('collections'));
    }

    public function create()
    {
        return view('collections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        RecipeCollection::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
        ]);

        return redirect()->route('collections.index')->with('success', 'Collection created successfully.');
    }

    public function show(RecipeCollection $collection)
    {
        return view('collections.show', compact('collection'));
    }

    public function destroy(RecipeCollection $collection)
    {
        $collection->delete();
        return redirect()->route('collections.index')->with('success', 'Collection deleted successfully.');
    }
}

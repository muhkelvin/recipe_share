@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-6">Recipes</h1>
        <a href="{{ route('recipes.create') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-6">Submit a Recipe</a>
        <div class="flex flex-wrap -mx-2">
            @foreach($recipes as $recipe)
                <div class="w-full md:w-1/3 px-2 mb-6">
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-300">
                        <img src="{{ $recipe->image ? asset('storage/' . $recipe->image) : 'https://via.placeholder.com/300x200' }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h5 class="text-xl font-bold mb-2 text-gray-800">{{ $recipe->title }}</h5>
                            <p class="text-gray-600 mb-4">{{ Str::limit($recipe->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <a href="{{ route('recipes.show', $recipe) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Recipe</a>
                                <div class="flex space-x-2">
                                    <a href="{{ route('recipes.edit', $recipe) }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Edit Recipe</a>
                                    <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this recipe?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-block bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Delete Recipe</button>
                                    </form>
                                    <form action="{{ route('recipe_saved', $recipe) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                                        <button type="submit" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Add to Collection</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-4">Edit Recipe</h1>
        <form action="{{ route('recipes.update', $recipe) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" value="{{ old('title', $recipe->title) }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" rows="3" required>{{ old('description', $recipe->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="ingredients" class="block text-gray-700 text-sm font-bold mb-2">Ingredients</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="ingredients" name="ingredients" rows="3" required>{{ old('ingredients', $recipe->ingredients) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="instructions" class="block text-gray-700 text-sm font-bold mb-2">Instructions</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="instructions" name="instructions" rows="3" required>{{ old('instructions', $recipe->instructions) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Current Image</label>
                @if($recipe->image)
                    <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-auto mb-2">
                @else
                    <p>No image uploaded</p>
                @endif
                <label for="image" class="block text-gray-700 text-sm font-bold mb-2">New Image</label>
                <input type="file" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="image" name="image">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Recipe</button>
        </form>
    </div>
@endsection

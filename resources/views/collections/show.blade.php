@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-4">{{ $collection->name }}</h1>
        <div class="flex flex-wrap -mx-2">
            @foreach($collection->recipes as $recipe)
                <div class="w-full md:w-1/3 px-2 mb-4">
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg">
                        <img src="{{ $recipe->image ? asset('storage/' . $recipe->image) : 'https://via.placeholder.com/150' }}" class="w-full h-48 object-cover" alt="{{ $recipe->title }}">
                        <div class="p-4">
                            <h5 class="text-xl font-bold mb-2">{{ $recipe->title }}</h5>
                            <p class="text-gray-700 mb-4">{{ Str::limit($recipe->description, 100) }}</p>
                            <a href="{{ route('recipes.show', $recipe) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Recipe</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

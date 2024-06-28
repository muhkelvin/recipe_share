@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-4">{{ $recipe->title }}</h1>
        <img src="{{ $recipe->image ? asset('storage/' . $recipe->image) : 'https://via.placeholder.com/150' }}" alt="{{ $recipe->title }}" class="w-full rounded-lg mb-4">
        <p class="mb-4">{{ $recipe->description }}</p>

        <h2 class="text-2xl font-bold mb-2">Ingredients</h2>
        <p class="mb-4">{{ $recipe->ingredients }}</p>

        <h2 class="text-2xl font-bold mb-2">Instructions</h2>
        <p class="mb-4">{{ $recipe->instructions }}</p>

        <div class="mb-4">
            <h2 class="text-2xl font-bold mb-2">Ratings</h2>
            @foreach($recipe->ratings as $rating)
                <div class="mb-2">
                    <strong>{{ $rating->user->name }}</strong>: {{ $rating->rating }} stars
                    @if($rating->review)
                        <p>{{ $rating->review }}</p>
                    @endif
                </div>
            @endforeach
            <form action="{{ route('recipe_ratings.store', $recipe) }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="rating" class="block text-gray-700 text-sm font-bold mb-2">Rating</label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="rating" name="rating" required>
                        <option value="1">1 star</option>
                        <option value="2">2 stars</option>
                        <option value="3">3 stars</option>
                        <option value="4">4 stars</option>
                        <option value="5">5 stars</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="review" class="block text-gray-700 text-sm font-bold mb-2">Review</label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="review" name="review" rows="3"></textarea>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit Rating</button>
            </form>
        </div>

        <div class="mb-4">
            <h2 class="text-2xl font-bold mb-2">Comments</h2>
            @foreach($recipe->comments as $comment)
                <div class="mb-2">
                    <strong>{{ $comment->user->name }}</strong>: {{ $comment->comment }}
                </div>
            @endforeach
            <form action="{{ route('recipe_comments.store', $recipe) }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">Comment</label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="comment" name="comment" rows="3" required></textarea>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit Comment</button>
            </form>
        </div>
    </div>
@endsection

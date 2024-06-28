@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-4">My Collections</h1>
        <a href="{{ route('collections.create') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Create New Collection</a>
        <div class="flex flex-wrap -mx-2">
            @foreach($collections as $collection)
                <div class="w-full md:w-1/3 px-2 mb-4">
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg">
                        <div class="p-4">
                            <h5 class="text-xl font-bold mb-2">{{ $collection->name }}</h5>
                            <div class="flex justify-end">
                                <a href="{{ route('collections.show', $collection) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Collection</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

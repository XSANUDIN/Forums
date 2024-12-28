<!-- resources/views/thread/edit.blade.php -->
@extends('layout.layout')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Edit Post</h2>

        <form action="{{ route('thread.update', $thread->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title Input -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-semibold">Title</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    class="w-full p-2 border border-gray-300 rounded"
                    value="{{ old('title', $thread->title) }}"
                >
                @error('title')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Content Textarea -->
            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-semibold">Content</label>
                <textarea
                    name="content"
                    id="content"
                    class="w-full p-2 border border-gray-300 rounded"
                    rows="5"
                >{{ old('content', $thread->content) }}</textarea>
                @error('content')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image Section -->
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-semibold">Image</label>

                @if($thread->image)
                    <div class="flex items-center mb-2">
                        <img src="{{ asset('storage/' . $thread->image) }}" alt="Current Image" class="w-24 h-24 object-cover mr-2">
                        <button type="button" class="text-red-500 font-semibold" onclick="document.getElementById('delete-image').checked = true;">x</button>
                        <input type="checkbox" id="delete-image" name="delete_image" class="hidden">
                    </div>
                @endif

                <input
                    type="file"
                    name="image"
                    id="image"
                    class="w-full p-2 border border-gray-300 rounded"
                >
                @error('image')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Post</button>
        </form>
    </div>
@endsection

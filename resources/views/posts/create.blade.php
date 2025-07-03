@extends('layouts.app')

@section('content')
  <div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-semibold mb-4">{{ isset($post) ? 'Edit Post' : 'New Post' }}</h1>

    <form action="{{ isset($post) ? route('posts.update', $post) : route('posts.store') }}"
          method="POST">
      @csrf
      @if(isset($post))
        @method('PUT')
      @endif

      <label class="block mb-4">
        <span class="font-medium">Title</span>
        <input type="text"
               name="title"
               value="{{ old('title', $post->title ?? '') }}"
               class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-blue-500"
               placeholder="Enter post title">
        @error('title')<p class="mt-1 text-red-600">{{ $message }}</p>@enderror
      </label>

      <label class="block mb-4">
        <span class="font-medium">Body</span>
        <textarea name="body"
                  rows="6"
                  class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-blue-500"
                  placeholder="Write your content…">{{ old('body', $post->body ?? '') }}</textarea>
        @error('body')<p class="mt-1 text-red-600">{{ $message }}</p>@enderror
      </label>

      <button type="submit"
              class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
        {{ isset($post) ? 'Save Changes' : 'Publish' }}
      </button>
    </form>
  </div>
@endsection

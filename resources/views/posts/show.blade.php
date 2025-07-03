@extends('layouts.app')

@section('content')
  <article class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
    <time class="block mb-4 text-sm text-gray-500">
      {{ $post->published_at->format('M j, Y') }}
    </time>
    <div class="prose max-w-none">
      {!! nl2br(e($post->body)) !!}
    </div>
    <div class="mt-6 flex space-x-4">
      <a href="{{ route('posts.edit', $post) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Edit
      </a>
      <form action="{{ route('posts.destroy', $post) }}" method="POST">
        @csrf @method('DELETE')
        <button type="submit"
                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
                onclick="return confirm('Delete this post?')">
          Delete
        </button>
      </form>
    </div>
  </article>
@endsection

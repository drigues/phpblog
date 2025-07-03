@extends('layouts.app')

@section('content')
  <h1 class="text-2xl font-semibold mb-6">All Posts</h1>

  <div class="space-y-4">
    @foreach($posts as $post)
      <article class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
        <a href="{{ route('posts.show', $post) }}" class="text-xl font-bold hover:text-blue-600">
          {{ $post->title }}
        </a>
        <p class="mt-2 text-gray-700 line-clamp-2">
          {{ Str::limit($post->body, 200) }}
        </p>
        <time class="block mt-4 text-sm text-gray-500">
          {{ $post->published_at->format('M j, Y') }}
        </time>
      </article>
    @endforeach
  </div>
@endsection

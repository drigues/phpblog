@extends('layouts.app')
@section('content')
  <h1>Edit Post</h1>
  <form action="{{ route('posts.update', $post) }}" method="POST">
    @csrf @method('PUT')
    <label>Title:<br><input name="title" value="{{ old('title', $post->title) }}"></label><br><br>
    <label>Body:<br><textarea name="body">{{ old('body', $post->body) }}</textarea></label><br><br>
    <button type="submit">Save</button>
  </form>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','My Blog')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
  <nav class="bg-white shadow p-4 mb-6">
    <div class="max-w-3xl mx-auto flex justify-between">
      <a href="{{ route('posts.index') }}" class="font-bold">My Blog</a>
      <div>
        <a href="{{ route('posts.index') }}" class="mr-4 hover:underline">Home</a>
        <a href="{{ route('posts.create') }}" class="hover:underline">New Post</a>
      </div>
    </div>
  </nav>

  <main class="max-w-3xl mx-auto">
    @if(session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
        {{ session('success') }}
      </div>
    @endif

    @yield('content')
  </main>
</body>
</html>

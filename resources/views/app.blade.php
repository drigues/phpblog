<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>My Blog</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="p-4">
  <nav><a href="{{ route('posts.index') }}">Home</a> | <a href="{{ route('posts.create') }}">New Post</a></nav>
  <hr>
  @yield('content')
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/createBlog.css', 'resources/js/createBlog.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
            <form action="{{ isset($post) ? route('postUpdate', $post->id) : route('postSubmit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="title"> Title *</label>
            <input type="text" id="title" name="title"  value="{{ isset($post) ? $post->title : '' }}" required>
            
            <label for="body">Body *</label>
            <textarea id="body" name="body" required>{{ isset($post) ? $post->body : '' }}</textarea>
            
            <label for="thumbnail">Thumbnail</label>
            <input type="file" id="thumbnail" name="thumbnail">

            @if(isset($post) && $post->thumbnail)
                <p style="color: white">Current Thumbnail:</p>
                <img src="{{ asset('images/' . $post->thumbnail) }}" alt="Thumbnail" width="100">
            @endif
            
            <button type="submit">{{ isset($post) ? 'Update Post' : 'Create Post' }}</button>
        </form>

        </main>
        </div>
    </body>
</html>

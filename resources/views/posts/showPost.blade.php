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
            <div class="container">        
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <img src=" {{asset('images/' . $post->thumbnail)}}" alt = "{{$post->title}}" class="w-12/12 mb-8 shadow-xl">

                            <h1> {{ $post->title }}</h1>

                            <div class="text-gray-600 dark:text-gray-400 font-light">
                                <a href=" {{ route('profileView', $post->user->id)}}"><span> {{ $post->user->name }} </span></a>
                                <span> {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }} </span>
                            </div>

                            <p> {{ $post->body}} </p>

                        </div>
                    </div>
                </div>
            </div>


        </div>

        </main>
        </div>
    </body>
</html>

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
            <form action=" {{route('adminAddUserSubmit')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="title"> Name *</label>
            <input type="text" id="title" name="title"  value="" required>
            
            <label for="body">Email *</label>
            <input type="email" id="email" name="email"  value="" required>
            
            <label for="thumbnail">Password *</label>
            <input type="text" id="password" name="password" required>

            <label for="clearance_level_id">Clearance Level *</label>
            <select id="clearance_level_id" name="clearance_level_id" required>
                @foreach (\App\Models\ClearanceLevel::all() as $clearanceLevel)
                    <option value="{{ $clearanceLevel->id }}">{{ $clearanceLevel->name }}</option>
                @endforeach
            </select>
            
            <button type="submit">Add User</button>
        </form>

        </main>
        </div>
    </body>
</html>

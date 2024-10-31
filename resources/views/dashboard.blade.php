<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">All Blog Posts</h2>
                <ul class="space-y-4">
                        @foreach ($posts as $post)
                        <a href="{{ route('showPost', $post)}}" >
                                    <li class="border-b border-gray-200 dark:border-gray-700 pb-4">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $post->title }}</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                            By {{ $post->user->name }} &middot; {{ $post->date_published }}
                                        </p>
                                    </li>
                                </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

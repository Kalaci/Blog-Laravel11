<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex">
                    <div class="w-1/3 pr-8">
                        <!-- Profile Picture -->
                        <div class="flex flex-col items-center">
                            @if ($user->profile_picture)
                            <img src="{{ asset('images/' . $user->profile_picture) }}" 
                                 class="rounded-full object-cover mb-4"
                                 style="width: 150px; height: 150px;">
                            @else
                            <div class="rounded-full bg-gray-800 mb-4" style="width: 50px; height: 50px;">
                            </div>
                            @endif
                            <!-- Name -->
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mt-4">
                                {{ $user->name }}
                            </h3>
                            <!-- Location -->
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                {{ $user->location ?? 'Location not specified' }}
                            </p>
                            <!-- Description -->
                            <p class="text-gray-700 dark:text-gray-300 mt-4 text-center">
                                {{ $user->description ?? '' }}
                            </p>
                        </div>
                    </div>

                    <div class="w-2/3">
                    <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">User Posts</h3>
                        @forelse ($user->posts as $post)
                        <a href="{{ route('showPost', $post)}}" >
                            <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded shadow">
                                <h4 class="text-lg font-semibold">{{ $post->title }}</h4>
                                <p class="text-gray-700 dark:text-gray-300">{{ $post->content }}</p>
                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $post->created_at->format('M d, Y') }}</span>
                            </div>
                        </a>
                        @empty
                            <p class="text-gray-600 dark:text-gray-400">This user has no posts.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

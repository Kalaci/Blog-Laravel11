<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6  text-gray-800 dark:text-gray-200 leading-tight">
                <h2 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">Admin Dashboard</h2>
                
                <!-- Flex container -->
                <div class="flex space-x-4">
                    <!-- Left side: Counts -->
                    <div class="w-1/3 bg-gray-100 dark:bg-gray-800 p-4 rounded">
                        <p class="text-xl font-semibold mb-4">Dashboard Summary</p>
                        <p>Total Number of Users: {{ $usersCount }}</p>
                        <p class="mt-4">Total Number of Posts: {{ $postsCount }}</p>
                        <a href="{{ route('viewAddUser')}}">
                            <button class="bg-white text-gray-800 px-4 py-2 rounded mt-6 w-full shadow-md hover:bg-gray-200">
                                Add User
                            </button>
                        </a>                    
                    </div>
                                        
                    <!-- Right side: Scrollable lists -->
                    <div class="w-2/3 space-y-4 ">
                        <!-- Scrollable Users -->
                        <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded h-48 overflow-y-scroll">
                            <p class="text-xl font-semibold mb-4 ">All Users</p>
                            
                            <ul class="space-y-2">
                                @foreach ($users as $user)
                                    <li class="flex justify-between items-center border-b border-gray-300 dark:border-gray-600 pb-2">
                                        {{ $user->name }} ({{ $user->email }})
                                        <a href="{{ url('admin/user/delete/'.$user->id) }}" class="text-red-500" onclick="return confirm('Are you sure?')">
                                            <button class="bg-red-600 text-white px-2 py-1 rounded">Delete</button>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <!-- Scrollable Posts -->
                        <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded h-48 overflow-y-scroll">
                            <p class="text-xl font-semibold mb-4">All Posts</p>
                            <ul class="space-y-2">
                                @foreach ($posts as $post)
                                <li class="flex justify-between items-center border-b border-gray-300 dark:border-gray-600 pb-2">
                                {{ $post->title }} 
                                        <a href="{{ url('admin/post/delete/'.$post->id) }}" class="text-red-500" onclick="return confirm('Are you sure?')">
                                            <button class="bg-red-600 text-white px-2 py-1 rounded">Delete</button>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-500 text-white p-4 rounded">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
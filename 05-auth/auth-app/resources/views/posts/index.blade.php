<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">All Posts</h3>
                        <a href="{{ route('posts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create Post
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="space-y-4">
                        @foreach($posts as $post)
                            <div class="border rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h4 class="text-xl font-semibold mb-2">
                                            <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:text-blue-800">
                                                {{ $post->title }}
                                            </a>
                                        </h4>
                                        <p class="text-gray-600 mb-2">{{ Str::limit($post->content, 150) }}</p>
                                        <p class="text-sm text-gray-500">By {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        @can('update', $post)
                                            <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white text-sm px-3 py-1 rounded">
                                                Edit
                                            </a>
                                        @endcan
                                        @can('delete', $post)
                                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white text-sm px-3 py-1 rounded" onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-6">
                        <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
                        <div class="text-gray-600 mb-4">
                            <p>By {{ $post->user->name }} on {{ $post->created_at->format('M d, Y \a\t g:i A') }}</p>
                        </div>
                        <div class="prose max-w-none">
                            <p class="text-gray-800 leading-relaxed">{{ $post->content }}</p>
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <a href="{{ route('posts.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Posts
                        </a>
                        
                        @can('update', $post)
                            <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Edit Post
                            </a>
                        @endcan
                        
                        @can('delete', $post)
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this post?')">
                                    Delete Post
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-gray-800">
            ← Назад до списку
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        @if($post->image_path)
            <img src="{{ Storage::url($post->image_path) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
        @endif
        
        <div class="p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>
            
            <div class="flex items-center text-sm text-gray-500 mb-6">
                <span>Автор: {{ $post->user->name }}</span>
                <span class="mx-2">•</span>
                <span>Опубліковано: {{ $post->created_at->format('d.m.Y H:i') }}</span>
            </div>

            <div class="prose max-w-none">
                <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $post->content }}</p>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex space-x-4">
                    <a href="{{ route('posts.edit', $post) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Редагувати
                    </a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" onclick="return confirm('Ви впевнені?')">
                            Видалити
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
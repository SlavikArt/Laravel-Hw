@extends('layouts.app')

@section('title', 'Всі пости')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-4">Всі пости</h1>
    <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
        Створити новий пост
    </a>
</div>

@if($posts->count() > 0)
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach($posts as $post)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if($post->image_path)
                    <img src="{{ Storage::url($post->image_path) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $post->title }}</h2>
                    <p class="text-gray-600 mb-4">{{ Str::limit($post->content, 150) }}</p>
                    <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
                        <span>Автор: {{ $post->user->name }}</span>
                        <span>{{ $post->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('posts.show', $post) }}" class="text-blue-500 hover:text-blue-700">Переглянути</a>
                        <a href="{{ route('posts.edit', $post) }}" class="text-green-500 hover:text-green-700">Редагувати</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Ви впевнені?')">Видалити</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="text-center py-12">
        <h3 class="text-lg text-gray-600 mb-4">Поки що немає постів</h3>
        <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
            Створити перший пост
        </a>
    </div>
@endif
@endsection 
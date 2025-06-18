@extends('layouts.app')

@section('title', 'Редагувати пост')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Редагувати пост</h1>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Заголовок поста *</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Введіть заголовок поста" required>
            </div>

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Зміст поста *</label>
                <textarea name="content" id="content" rows="8" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                          placeholder="Введіть зміст поста" required>{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Зображення (необов'язково)</label>
                @if($post->image_path)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Поточне зображення:</p>
                        <img src="{{ Storage::url($post->image_path) }}" alt="Поточне зображення" class="w-32 h-32 object-cover rounded">
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <p class="text-sm text-gray-500 mt-1">Підтримуються формати: JPEG, PNG, JPG, GIF. Максимальний розмір: 2MB</p>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('posts.show', $post) }}" class="text-gray-600 hover:text-gray-800">
                    ← Назад до поста
                </a>
                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                    Оновити пост
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 
@extends('layouts.app')

@section('title', 'Створити новий пост')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Створити новий пост</h1>
        <p class="text-gray-600">Після створення поста всі користувачі з дозволеними нотифікаціями отримають повідомлення на email та Telegram.</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Заголовок поста *</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Введіть заголовок поста" required>
            </div>

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Зміст поста *</label>
                <textarea name="content" id="content" rows="8" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                          placeholder="Введіть зміст поста" required>{{ old('content') }}</textarea>
            </div>

            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Зображення (необов'язково)</label>
                <input type="file" name="image" id="image" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <p class="text-sm text-gray-500 mt-1">Підтримуються формати: JPEG, PNG, JPG, GIF. Максимальний розмір: 2MB</p>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-gray-800">
                    ← Назад до списку
                </a>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                    Створити пост
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 
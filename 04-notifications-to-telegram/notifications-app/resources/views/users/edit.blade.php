@extends('layouts.app')

@section('title', 'Редагувати користувача')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Редагувати користувача</h1>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Ім'я *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       required>
            </div>

            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       required>
            </div>

            <div class="mb-6">
                <label for="telegram_user_id" class="block text-sm font-medium text-gray-700 mb-2">Telegram User ID</label>
                <input type="text" name="telegram_user_id" id="telegram_user_id" value="{{ old('telegram_user_id', $user->telegram_user_id) }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="123456789">
                <p class="text-sm text-gray-500 mt-1">Отримайте свій Telegram ID через @getmyid_bot</p>
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="notification_allowed" value="1" 
                           {{ old('notification_allowed', $user->notification_allowed) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-700">Дозволити нотифікації</span>
                </label>
                <p class="text-sm text-gray-500 mt-1">Якщо увімкнено, користувач буде отримувати нотифікації про нові пости</p>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('users.index') }}" class="text-gray-600 hover:text-gray-800">
                    ← Назад до списку
                </a>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                    Оновити користувача
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 
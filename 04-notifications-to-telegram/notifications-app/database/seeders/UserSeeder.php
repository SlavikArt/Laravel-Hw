<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Створюємо тестових користувачів
        User::create([
            'name' => 'Тестовий користувач 1',
            'email' => 'user1@example.com',
            'password' => Hash::make('password'),
            'notification_allowed' => true,
            'telegram_user_id' => '490526172', // Реальний Telegram ID
        ]);

        User::create([
            'name' => 'Тестовий користувач 2',
            'email' => 'user2@example.com',
            'password' => Hash::make('password'),
            'notification_allowed' => true,
            'telegram_user_id' => '490526172', // Той самий ID для тестування
        ]);

        User::create([
            'name' => 'Користувач без нотифікацій',
            'email' => 'no-notifications@example.com',
            'password' => Hash::make('password'),
            'notification_allowed' => false,
            'telegram_user_id' => null,
        ]);
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\User;
use App\Notifications\NewPostNotification;
use Illuminate\Console\Command;

class TestNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:notifications {--post-id= : ID поста для тестування}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Тестування нотифікацій для поста';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $postId = $this->option('post-id');
        
        if ($postId) {
            $post = Post::find($postId);
            if (!$post) {
                $this->error("Пост з ID {$postId} не знайдено!");
                return 1;
            }
        } else {
            // Створюємо тестовий пост
            $post = Post::create([
                'title' => 'Тестовий пост для нотифікацій',
                'content' => 'Це тестовий пост для перевірки роботи нотифікацій. Він був створений автоматично через команду.',
                'user_id' => 1,
            ]);
            $this->info("Створено тестовий пост з ID: {$post->id}");
        }

        $users = User::where('notification_allowed', true)->get();
        
        if ($users->isEmpty()) {
            $this->warn('Немає користувачів з дозволеними нотифікаціями!');
            return 1;
        }

        $this->info("Відправляємо нотифікації для поста: {$post->title}");
        $this->info("Кількість користувачів: {$users->count()}");

        $bar = $this->output->createProgressBar($users->count());
        $bar->start();

        foreach ($users as $user) {
            try {
                $user->notify(new NewPostNotification($post));
                $bar->advance();
            } catch (\Exception $e) {
                $this->newLine();
                $this->error("Помилка відправки нотифікації для {$user->email}: {$e->getMessage()}");
            }
        }

        $bar->finish();
        $this->newLine();
        $this->info('Нотифікації відправлено!');
        
        return 0;
    }
}

<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class NewPostNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Post $post
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['telegram']; // Only send Telegram notifications for now
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $message = (new MailMessage)
            ->subject('Новий пост: ' . $this->post->title)
            ->greeting('Привіт, ' . $notifiable->name . '!')
            ->line('Опубліковано новий пост на нашому блозі.')
            ->line('Заголовок: ' . $this->post->title)
            ->line('Автор: ' . $this->post->user->name)
            ->line('Опубліковано: ' . $this->post->created_at->format('d.m.Y H:i'));

        if ($this->post->image_path) {
            $message->attach(storage_path('app/public/' . $this->post->image_path));
        }

        return $message;
    }

    /**
     * Get the Telegram representation of the notification.
     */
    public function toTelegram(object $notifiable): TelegramMessage
    {
        $message = TelegramMessage::create()
            ->content("🆕 *Новий пост на блозі!*\n\n" .
                "📝 *" . $this->post->title . "*\n\n" .
                "👤 Автор: " . $this->post->user->name . "\n" .
                "📅 Опубліковано: " . $this->post->created_at->format('d.m.Y H:i') . "\n\n" .
                "📖 " . substr($this->post->content, 0, 200) . "...");

        if ($this->post->image_path) {
            $message->photo(storage_path('app/public/' . $this->post->image_path));
        }

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'post_id' => $this->post->id,
            'title' => $this->post->title,
            'author' => $this->post->user->name,
        ];
    }
}

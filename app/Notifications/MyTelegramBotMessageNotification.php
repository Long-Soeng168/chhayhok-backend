<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class ContactFormTelegramNotification extends Notification
{
    use Queueable;

    public $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['telegram'];
    }

    /**
     * Get the Telegram representation of the notification.
     */
    public function toTelegram(object $notifiable)
    {
        return TelegramMessage::create()
            ->content(
                "*New Contact Form Message!*\n\n" .
                    "👤 *Full Name:* {$this->data['full_name']}\n" .
                    "🏢 *Company Name:* " . ($this->data['company_name'] ?? 'N/A') . "\n" .
                    "📞 *Telephone:* {$this->data['telephone']}\n" .
                    "✉️ *Email:* {$this->data['email']}\n" .
                    "📍 *Address:* {$this->data['address']}\n" .
                    "📌 *Subject:* {$this->data['subject']}\n\n" .
                    "📝 *Inquiry:*\n{$this->data['inquiry']}"
            )
            ->to('-4664327715');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return $this->data;
    }
}

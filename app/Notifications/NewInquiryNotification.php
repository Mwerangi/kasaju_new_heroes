<?php

namespace App\Notifications;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewInquiryNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $inquiry;

    /**
     * Create a new notification instance.
     */
    public function __construct(Inquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $inquiryUrl = route('admin.inquiries.show', $this->inquiry->id);

        return (new MailMessage)
                    ->subject('New Inquiry Received - ' . $this->inquiry->name)
                    ->greeting('New Inquiry Notification')
                    ->line('A new inquiry has been submitted through the website.')
                    ->line('**Name:** ' . $this->inquiry->name)
                    ->line('**Email:** ' . $this->inquiry->email)
                    ->line('**Phone:** ' . ($this->inquiry->phone ?? 'Not provided'))
                    ->line('**Company:** ' . ($this->inquiry->company ?? 'Not provided'))
                    ->line('**Service:** ' . ($this->inquiry->service ?? 'Not specified'))
                    ->line('**Message:**')
                    ->line($this->inquiry->message)
                    ->action('View Inquiry Details', $inquiryUrl)
                    ->line('Please respond to this inquiry as soon as possible.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'inquiry_id' => $this->inquiry->id,
            'name' => $this->inquiry->name,
            'email' => $this->inquiry->email,
            'service' => $this->inquiry->service,
        ];
    }
}

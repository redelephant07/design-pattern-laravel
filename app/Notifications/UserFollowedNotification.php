<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserFollowedNotification extends Notification
{
    use Queueable;

    // Store the follower instance
    protected $follower;

    /**
     * Create a new notification instance.
     *
     * @param User $follower The user who is following
     */
    public function __construct($follower)
    {
        // Assign the follower instance to the property
        $this->follower = $follower;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        // Specify the delivery channel(s) for the notification (e.g., 'mail')
        return ['mail']; // You can add other channels if needed
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
   public function toMail($notifiable)
{
    return (new MailMessage)
        ->from('your-email@example.com', 'Your Name')  // Set the "From" header
        ->line('You have a new follower!')
        ->action('View Profile', url('/profile'))
        ->line('Thank you for using our application!');
}
}

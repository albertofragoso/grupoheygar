<?php

namespace App\Notifications;

use App\Product;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProductCreate extends Notification
{
    use Queueable;

    public $user;
    public $product;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Product $product)
    {
        $this->user = $user;
        $this->product = $product;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
      if ($notifiable->id == 10) {
        return (new \App\Mail\ProductCreate($notifiable->name, $this->product))->to($notifiable->routeNotificationFor('mail'))->cc('jorgebuhl@gmail.com');
      }
      else {
        return (new \App\Mail\ProductCreate($notifiable->name, $this->product))->to($notifiable->routeNotificationFor('mail'));
      }
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
     public function toArray($notifiable)
     {
         return [
             'user' => $this->user,
             'product' => $this->product,
         ];
     }
}

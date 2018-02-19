<?php

namespace App\Notifications;

use App\User;
use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProductMessage extends Notification
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
        //return ['mail', 'database', 'broadcast'];
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
        return (new MailMessage)
                    ->subject('Tienes un nuevo comentario de algún trabajo')
                    ->greeting('¡Hola, '. $notifiable->name .'!')
                    ->line('El cliente '. $this->user->name . ' ha comentado su producto.')
                    ->action('Revisa qué opinó', url('/products/' .$this->product->id))
                    ->salutation('Gracias por trabajar con Grupo Heygar');
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

    /*public function toBroadcast($notifiable)
    {
      return new BroadcastMessage([
        'data' => $this->toArray($notifiable)
      ]);
    }*/
}

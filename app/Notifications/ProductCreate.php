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
      return (new MailMessage)
                  ->subject('Se ha iniciado tu pedido')
                  ->greeting('¡Hola, '. $notifiable->name .'!')
                  ->line('Hemos iniciado el trabajo de tu producto.')
                  ->action('Revisa su status', url('/products/' .$this->product->id))
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
}

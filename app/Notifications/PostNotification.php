<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use App\User;


class PostNotification extends Notification
{
    use Queueable;
    public $fromUser;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $greeting = sprintf('Sr/a %s !', $notifiable->names);
        return (new MailMessage)
                    ->subject('Reclamo de material')
                    ->greeting($greeting)
                    ->line('Me dirijo a usted a efectos de informarle que figura en nuetro sistema que usted posee el material que abajo se detalla:')
                    ->line('')
                    ->line($this->post->descripcion)
                    ->line('')
                    ->line('Los plazos del préstamo han vencido, es por ello, que solicitamos su devolución a la brevedad o requerir una renovación del mismo.')
                    ->line('Muchas gracias !');
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
            'post' => $this->post->id,
            'titulo' => $this->post->titulo,
            'descripcion' => $this->post->descripcion,
            'time' => Carbon::now()->diffForHumans(),
        ];
    }
}

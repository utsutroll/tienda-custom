<?php

namespace App\Notifications;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApprovedPaymentMail extends Notification
{
    use Queueable;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $user = User::find($this->order->user_id);

        return (new MailMessage)->view('admin.mails.mail-approved-payment', ['order' => $this->order, 'user' => $user])
                    ->subject('Compra Aprobada')
                    /* ->greeting('Hola,  Euclides Ollarves')
                    ->line('Nos complace notificarle que su compra (#3) con el monto de 15$ ha sido aprovada.')
                    ->line('puede pasar a retirar su pedido en nuestros horario de trabajo.')
                    ->line('Desde 7:00 AM hasta las 6:00 PM.')
                    ->action('Ver detalles de la compra', route('user.orderdetails',['order_id'=>3]))
                    ->line('Gacias por comprar en nuestra tienda!')
                    ->line('Te esperamos!') */;
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
            //
        ];
    }
}

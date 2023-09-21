<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use NotificationChannels\PusherPushNotifications\PusherChannel;
use Pusher\PushNotifications\PushNotifications;
use NotificationChannels\PusherPushNotifications\PusherMessage;

class PaidFreelance extends Notification implements ShouldQueue
{
    use Queueable;
    public $montant;
    public $title;
    public $service;

    /**
     * Create a new notification instance.
     */
    public function __construct($montant , $title ,$service = null)
    {
        //

        $this->montant= $montant ." $";
        $this->title = $title;
        $this->service = $service;


    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [PusherChannel::class, "database"];
    }


    public function toDatabase($notifiable)
    {
        return [
            'title' => "Paiement",
            'message' => 'Nouveau Paiement de ' .   $this->montant . ' pour ' . $this->service ??'pour le service' . ' a été passée.',
            'url' => '/freelance/paiement/',
            'icon' => 'fa fa-cart-shopping',

        ];
    }


    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Nouvelle commande de')
            ->action('Notification Action', url('/freelance/paiement/'))
            ->line('Thank you for using our application!');
    }

    public function toPushNotification($notifiable)
    {
        $beamsClient = new PushNotifications(array(
            "instanceId" => config('services.pusher.beams_instance_id'),
            "secretKey" => config('services.pusher.beams_secret_key'),
        ));

        $interests = "App.Models.User.{$notifiable->id}";

        $data = array(
            "web" => array(
                "notification" => array(
                    "title" => "Nouvelle commande !",
                    "body" =>
                    'Vous avez une nouvelle commande de ' . $this->montant . ' pour' . $this->service??'' . '.',
                    "deep_link" => "http://localhost:8000/freelance/paiement/",
                    "icon" => "http://localhost:8000/images/logo/find_01.png",
                    "data" => array(
                        "foo" => "bar",
                        "baz" => "qux",
                    ),
                ),
            ),
        );

        $beamsClient->publishToInterests(array($interests), $data);
    }
}

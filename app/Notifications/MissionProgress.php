<?php

namespace App\Notifications;

use App\Models\FeedbackService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\MissionResponse;

use NotificationChannels\PusherPushNotifications\PusherChannel;
use Pusher\PushNotifications\PushNotifications;
use NotificationChannels\PusherPushNotifications\PusherMessage;


class MissionProgress extends Notification
{
    use Queueable;



    /**
     * Create a new notification instance.
     */
    public $feedback;
    public function __construct(FeedbackService $feedback)
    {
        //



        $this->feedback = $feedback;
    }

    public function via($notifiable)
    {
        return [PusherChannel::class, "database"];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => "Progression Mission",
            'message' => 'Nouvelle progression  ' . $this->feedback->mission->progress . ' pour la mission ' . $this->feedback->mission->title,
            'url' => '/feedbacks/' . $this->feedback->id,
            'icon' => 'fa fa-bars-progress',
        ];
    }


    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Nouvelle Progression')
            ->action('Notification Action', url('/feedbacks/' . $this->feedback->mission->id))
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
                    "title" => "Nouvelle  progression !",
                    "body" => 'Nouvelle progression de ' . $this->feedback->mission->progress . ' pour la mission ' . $this->feedback->order->title,
                    "deep_link" => "http://localhost:8000/freelance/commande",
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

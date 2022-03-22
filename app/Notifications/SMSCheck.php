<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SMSCheck extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($value,$dev)
    {
        $this->keyword = $value;
        $this->dev = $dev;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**

     */
    public function toDatabase($notifiable)
    {
        return ['裝置:'.$this->dev->note.' @'.$this->dev->name.' 商家:'.$this->dev->businesses.'號碼:'.$this->dev->number.' 含有關鍵字:'.$this->keyword];
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
            '裝置:'.$this->dev->note.' @'.$this->dev->name.' 商家:'.$this->dev->businesses.'號碼:'.$this->dev->number.' 含有關鍵字:'.$this->keyword
        ];
    }
}

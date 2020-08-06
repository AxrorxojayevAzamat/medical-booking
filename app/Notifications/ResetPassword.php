<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class ResetPassword extends Notification
{

    public $token;

    
    public static $toMailCallback;

   
    public function __construct($token) {
        $this->token = $token;
    }
   
    public function via($notifiable) {
        return ['mail'];
    }

       public function toMail($notifiable) {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage)
                        ->subject(Lang::get('Восстановление пароля'))
                        ->line(Lang::get('Нажмите кнопку ниже, чтобы сбросить пароль'))
                        ->action(Lang::get('Сброс пароля.'), url(config('app.url') . route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
                        ->line(Lang::get('Этот URL будет активен в течение :count min.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]));
    }

    
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }

}

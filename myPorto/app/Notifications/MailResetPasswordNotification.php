<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Auth\Notifications\ResetPassword;

class MailResetPasswordNotification extends ResetPassword
{
    use Queueable;

    public function toMail($notifiable)
    {
        if(static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }
        return (new MailMessage())
        ->subject('パスワードリセット通知')
        ->view('mails.password-reset', [
            'reset_url' => url(config('app.url') . '/reset-password'.'/'.$this->token.'/'.$notifiable->getEmailForPasswordReset() )]);

    }
}

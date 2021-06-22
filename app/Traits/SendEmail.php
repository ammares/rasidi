<?php

namespace App\Traits;

use App\Models\EmailTemplate;
use Illuminate\Database\Eloquent\Model;
use MiniAndMore\ComponentNotification\ComponentNotification;

trait SendEmail
{

    public function sendEmail($notifiable, $email_template_name, $replace_data = [], $replace_subject_vars = true, $lang = null)
    {
        $lang = $lang ?: app()->getLocale();
        $email_address = $notifiable instanceof Model ? $notifiable->email : $notifiable;
        $email = EmailTemplate::parseContent($email_template_name, $replace_data, $replace_subject_vars);
        
        if (!count($email)) {
            return;
        }

        ComponentNotification::make()
            ->from(config('system-preferences.email_from_address'), config('system-preferences.email_from_name'))
            ->subject($email['subject'])
            ->with(['mail'])
            ->markdown('emails.default_email')
            ->send($notifiable, [
                'email_template_id' => $email['id'],
                'content' => $email['message'],
                'lang' => $lang,
                'email' => $email_address,
            ]);
    }
}

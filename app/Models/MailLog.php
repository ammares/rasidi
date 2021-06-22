<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MailLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_template_id',
        'subject',
        'status',
        'meta',
        'notify_to',
        'notify_by',
        'fired_id',
        'fired_type',
        'fired_at',
    ];

    public static function loadByTemplateByStatus($id, $category, $status)
    {
        return self::select(
            'mail_logs.id',
            'mail_logs.notify_to as email',
            'mail_logs.meta as meta',
            'mail_logs.created_at as sent_at',
            ($category=='client'
            ?DB::raw('CONCAT(clients.first_name, " ", clients.last_name) as full_name')
            :'users.name as full_name'
            )
        )
            ->leftjoin('clients', 'clients.email', '=', 'mail_logs.notify_to')
            ->leftjoin('users', 'users.email', '=', 'mail_logs.notify_to')
            ->where([
                'mail_logs.email_template_id' => $id,
                'mail_logs.status' => $status,
            ])
            ->orderBy('mail_logs.created_at', 'desc')
            ->get(); 
    }
}

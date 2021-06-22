<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailLogContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'mail_log_id',
        'content',
    ];
}

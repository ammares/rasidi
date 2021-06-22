<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MqttRequestTemp extends Model
{
    use HasFactory;

    protected $fillable = [
        'payload',
        'payload_at',
    ];

    public function user(){
        return $this->belongsTo(Client::class);
    }
}

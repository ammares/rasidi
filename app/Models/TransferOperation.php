<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferOperation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'category_id',
        'mobile',
        'sim_type',
        'status',
    ];
}

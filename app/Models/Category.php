<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'price',
    ];

    public static function loadAll()
    {
        
        return self::select(
            'id',
            'amount',
            'price',
            'created_at'
            )->orderBy('amount')
            ->get();
    }
}

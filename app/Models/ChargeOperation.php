<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargeOperation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'client_id',
        'amount',
    ];

    public static function loadAll()
    {
        return self::select(
            'charge_operations.id as id',
            'users.name as user_name',
            'clients.first_name as client_first_name',
            'clients.last_name as client_last_name',
            'clients.mobile as client_mobile',
            'charge_operations.amount as amount',
            'charge_operations.created_at as created_at',
            )
            ->join('clients','clients.id','charge_operations.client_id')
            ->join('users','users.id','charge_operations.user_id')
            ->get();
    }
}

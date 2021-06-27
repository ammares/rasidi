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

    public static function loadAll()
    {
        return self::select(
            'transfer_operations.id as id',
            'clients.first_name as client_first_name',
            'clients.last_name as client_last_name',
            'transfer_operations.mobile as mobile',
            'categories.amount as amount',
            'transfer_operations.sim_type as sim_type',
            'transfer_operations.status as status',
            )
            ->join('clients','clients.id','transfer_operations.client_id')
            ->join('categories','categories.id','transfer_operations.category_id')
            ->get();
    }
}

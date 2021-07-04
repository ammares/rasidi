<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientsBill extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'bill_type',
        'value',
        'paid',
        'payment_at',
    ];

    public static function loadAll()
    {
        return self::select(
            'clients_bills.id as id',
            'clients.first_name as client_first_name',
            'clients.last_name as client_last_name',
            'clients.national_num as national_num',
            'clients_bills.bill_type as bill_type',
            'clients_bills.value as value',
            'clients_bills.paid as paid',
            'clients_bills.payment_at as payment_at',
            )
            ->join('clients','clients.id','clients_bills.client_id')
            ->get();
    }
}

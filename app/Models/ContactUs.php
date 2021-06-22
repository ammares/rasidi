<?php

namespace App\Models;

use App\Traits\DataViewer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ContactUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'subject',
        'message',
        'replied_at',
    ];

    public static function loadAll(bool $export = false)
    {
        DB::connection()->enableQueryLog();

        $query = self::select([
            'contact_us.id',
            'contact_us.created_at as contacted_at',
             DB::raw('CONCAT(clients.first_name, " ", clients.last_name) as client_name'),
            'contact_us.subject',
            'contact_us.message',
            'contact_us.replied_at',
            'clients.email as client_email',
            'clients.mobile as client_mobile'
        ])->join('clients', 'clients.id', '=', 'contact_us.client_id');
        
        $response = DataViewer::searchDataGrid($query, [
            'clients.first_name',
            'clients.last_name',
            'contact_us.subject'
        ], $export);

        $response['query'] = DB::getQueryLog();

        return $response;
    }

}

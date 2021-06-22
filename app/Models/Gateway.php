<?php

namespace App\Models;

use App\Traits\DataViewer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gateway extends Model
{
    use HasFactory, DataViewer;

    protected $fillable = [
        'serial_number',
        'description',
        'active',
    ];

    public function clientGateway()
    {
        return $this->hasOne(ClientGateway::class, 'gateway_id');
    }

    public function clientDevices()
    {
        return $this->hasMany(ClientDevice::class);
    }

    //------------- Admin Functions ---------------------//

    public static function loadAll(bool $export = false)
    {
        DB::connection()->enableQueryLog();

        $query = self::select([
            'gateways.id',
            'gateways.serial_number',
            'gateways.description',
            'gateways.active',
            'gateways.created_at',
        ])
            ->with('clientGateway')
            ->withCount('clientDevices');

        $response = DataViewer::searchDataGrid($query, [
            'gateways.serial_number',
        ], $export);

        $response['query'] = DB::getQueryLog();

        return $response;
    }

    public static function getDetails($id)
    {
        return self::select([
            'id',
            'serial_number',
            'description',
            'active',
        ])
            ->where('id', '=', $id)
            ->with([
                'clientGateway',
                'clientGateway.client:id,first_name,last_name,email,solar_pv,battery_storage',
                'clientDevices',
                'clientDevices.device',
            ])
            ->first();
    }
}

<?php

namespace App\Models;

use App\Traits\DataViewer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'mobile',
        'phone',
        'active',
        'ban',
        'verified',
        'national_num',
        'balance',
        'address',
    ];


    /*protected $hidden = [
        'password',
    ];*/

    public static function boot()
    {
        parent::boot();

        static::creating(function (Client $client) {
            if (!App::runningInConsole()) {
                $client->password = bcrypt(request()->input('password'));
                //$client->email_verification_code = rand(1001, 9999);
                //$client->email_expired_at = now()->addDays(3);
                $client->verified = '0';
            }
        });
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getLocationAttribute()
    {
        return implode(",", array_filter([$this->latitude, $this->longitude]));
    }

    public function mqttRequestTemp()
    {
        return $this->hasMany(MqttRequestTemp::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    //------------- Admin Functions ---------------------//

    public static function loadAll(bool $export = false)
    {
        DB::connection()->enableQueryLog();

        $query = self::select([
            'id',
            'first_name',
            'middle_name',
            'last_name',
            'password',
            'mobile',
            'phone',
            'active',
            'ban',
            'national_num',
            'balance',
            'address',
            ]);

        $response = DataViewer::searchDataGrid($query, [
            'CONCAT(first_name, " ", last_name)',
            'email',
        ], $export);

        $response['query'] = DB::getQueryLog();

        return $response;
    }

}

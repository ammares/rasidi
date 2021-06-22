<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemPreference extends Model
{
    public $timestamps = false;
    protected $fillable = ['key', 'value', 'type'];

    public static function getValue($key)
    {
        return SystemPreference::where('key', $key)->value('value');
    }

    public static function getByType($type)
    {
        return self::where('type', $type)->get();
    }

    public static function getByName($name)
    {
        return self::where('key', $name)->first();
    }
}

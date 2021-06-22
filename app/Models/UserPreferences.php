<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class UserPreferences extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'key', 'value'];
    public $timestamps = false;

    public static function getByKey($value)
    {
        return UserPreferences::where([
            ['user_id', request()->user()->id],
            ['key', $value],
        ])->value('value');
    }

    public static function getByKeyByUser($user_id, $value)
    {
        return UserPreferences::where([
            ['user_id', $user_id ?? request()->user()->id],
            ['key', $value],
        ])->value('value');
    }
}

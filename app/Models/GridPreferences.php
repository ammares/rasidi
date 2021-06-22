<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class GridPreferences extends Model
{
    protected $fillable = ['user_id', 'key_name', 'key_value'];

    public static function loadByKey($grid_name, $user_id)
    {
        $gridOptions = GridPreferences::where(
            [
                ['user_id', '=', $user_id],
                ['key_name', '=', $grid_name],
            ]
        )->first();

        return !empty($gridOptions->key_value) ? json_decode($gridOptions->key_value) : [];
    }

    public static function store($key_name, $key_value)
    {
        return GridPreferences::updateOrCreate(
            ['user_id' => Auth::user()->id, 'key_name' => $key_name],
            ['key_value' => json_encode($key_value)]
        );
    }
}

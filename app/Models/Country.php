<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    public static function options()
    {
        return self::pluck('name', 'id')
            ->prepend(__('global.choose_one'), '');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntroductionTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'summary'
    ];
}

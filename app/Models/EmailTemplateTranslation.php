<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplateTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['subject', 'message'];
}

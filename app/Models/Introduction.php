<?php

namespace App\Models;

use App\Helpers\Helper;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Introduction extends Model implements TranslatableContract
{
    use Translatable;

    protected $fillable = [
        'order',
        'image',
        'type',
    ];

    public $translatedAttributes = ['title', 'summary'];

    public static function loadAllHowItWorks()
    {
        $lang = Helper::getPortalDataLang();

        return self::select(
            'introductions.type',
            'introductions.id',
            'introductions.order',
            'introductions.image',
            DB::raw("(select title from introduction_translations
             where introduction_translations.introduction_id = introductions.id and introduction_translations.locale = '$lang'
             limit 1) as title"),
            DB::raw("(select summary from introduction_translations
             where introduction_translations.introduction_id = introductions.id and introduction_translations.locale = '$lang'
             limit 1) as summary"))
            ->where('type','how_it_works')
            ->orderBy('order')
            ->get();
    }

    public static function loadAllKeyFeatures()
    {
        $lang = Helper::getPortalDataLang();

        return self::select(
            'introductions.type',
            'introductions.id',
            'introductions.order',
            'introductions.image',
            DB::raw("(select title from introduction_translations
             where introduction_translations.introduction_id = introductions.id and introduction_translations.locale = '$lang'
             limit 1) as title"),
            DB::raw("(select summary from introduction_translations
             where introduction_translations.introduction_id = introductions.id and introduction_translations.locale = '$lang'
             limit 1) as summary"))
            ->where('type','key_features')
            ->orderBy('order')
            ->get();
    }

}

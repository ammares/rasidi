<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmailTemplate extends Model implements TranslatableContract
{
    use Translatable;
    protected $fillable = [
        'category',
        'name',
        'rule',
        'active',
    ];

    public $translatedAttributes = ['subject', 'message'];

    public function getNameAttribute($value)
    {
        return Str::of($value)->replace('_', ' ');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::of($value)->trim()->replace(' ', '_');
    }

    public static function parseContent($template = '', $replace_data = [], $replace_subject_vars = true)
    {
        $email = self::where('name', $template)->first();

        if (is_null($email)) {
            return [];
        }

        $message = $email->message;
        $email_subject = $email->subject;
        foreach ($replace_data as $key => $value) {
            $message = str_replace('{' . $key . '}', $value, $message);
            $email_subject = $replace_subject_vars
            ? str_replace('{' . $key . '}', $value, $email_subject)
            : $email_subject;
        }

        return ['id' => $email->id, 'message' => $message, 'subject' => $email_subject];
    }

    public function successMailLogs()
    {
        return $this->hasMany(MailLog::class, 'email_template_id')->where('status', 'success');
    }

    public function errorMailLogs()
    {
        return $this->hasMany(MailLog::class, 'email_template_id')->where('status', 'error');
    }

    public static function loadAllByCategory()
    {
        return self::select(
            'email_templates.category',
            'email_templates.id',
            'email_templates.active',
            DB::raw("replace(email_templates.name, '_', ' ') as name"),
            DB::raw("(GROUP_CONCAT(email_template_translations.locale SEPARATOR ' & ')) as `languages`"),
            'email_templates.rule',
            'email_templates.updated_at',
        )
            ->withCount('errorMailLogs')
            ->withCount('successMailLogs')
            ->join('email_template_translations', 'email_template_translations.email_template_id', '=', 'email_templates.id')
            ->groupBy('email_templates.id')
            ->get()
            ->groupBy('category')
            ->toArray();
    }

}

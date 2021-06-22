<?php

namespace App\Traits;

use App\Models\GridPreferences;
use Illuminate\Support\Arr;

trait Common
{
    protected $columns = [];

    public function setSelectedColumns()
    {
        if ('true' === request()->input('current_fields')) {
            $option = GridPreferences::loadByKey(request()->input('url'), request()->user()->id);
            $this->columns = request()->input('columns');
            foreach ($option->columns as $key => $column) {
                'false' === $column->visible ? Arr::pull($this->columns, $key) : false;
            }
            $this->columns = array_values($this->columns);
        }
    }

    public static function convertValidationErrorsToText($errors)
    {
        $text = '';
        foreach ($errors as $error) {
            if (is_array($error)) {
                foreach ($error as $e) {
                    $text .= $e.', ';
                }
            } else {
                $text .= $error.', ';
            }
        }

        return $text;
    }
}

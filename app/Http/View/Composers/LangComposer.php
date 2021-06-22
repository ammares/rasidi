<?php

namespace App\Http\View\Composers;

use App\Helpers\Helper;
use Illuminate\View\View;

class LangComposer
{
    public function compose(View $view)
    {
        $view->with([
            'grid_lang' => Helper::getPortalDataLang(),
        ]);
    }
}

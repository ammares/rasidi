@props(['gridLang', 'datatableReload' => false])

<div class="dropdown dropdown-language mr-1">
    <button class="btn btn-icon btn-flat-primary waves-effect dropdown-toggle hide-arrow" type="button"
        data-toggle="dropdown" aria-expanded="true">
        <i class="lang-icon mr-25 flag-icon flag-icon-{{config('translatable.locales')[$gridLang]}}"></i>
        <span class="lang-text text-uppercase">
            {{config('translatable.locales')[$gridLang]}}</span>
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag">
        @foreach(config('translatable.locales') as $key => $value)
        <a class="dropdown-item text-uppercase" href="javascript:;"
            onclick="changeGridLangPreference('{{$key}}', 'portal_data_lang', jQuery(this).parent().prev(), {{$datatableReload}})">
            <i class="mr-25 flag-icon flag-icon-{{$value}}"></i> {{$value}}
        </a>
        @endforeach
    </div>
</div>
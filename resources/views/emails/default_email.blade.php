@component('vendor.mail.layout')
    {{-- Header --}}
    @slot('header')
        @component('vendor.mail.header', ['url' => url('/')])
            <img style="width: 150px; height: auto; max-height: 100%;"
                 src="{{url('storage/system_preferences/' . config('system-preferences.business_logo'))}}"
                 alt="{{config('system-preferences.business_name')}}"/>
        @endcomponent
    @endslot

    {{-- Body --}}
    {!! $content  !!}

    {{-- Footer --}}
    @slot('footer')
        @component('vendor.mail.footer')
            <div style="font-size: .9em">
                <p style="text-align: center !important; color: #718096"
                   @if(($lang ?? app()->getLocale()) === 'ar') dir="rtl" @endif>
                    @lang('global.this_email_was_sent_to', [], $lang ?? app()->getLocale())
                    <span dir="ltr">({{$email}})</span>
                </p>
                © {{config('system-preferences.business_name')}} {{ date('Y') }}
                @lang('global.all_rights_reserved', [], $lang ?? app()->getLocale())
            </div>
        @endcomponent
    @endslot
@endcomponent

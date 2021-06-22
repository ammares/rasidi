{{-- Vendor Scripts --}}
<script type="text/javascript" src="{{ asset('vendors/js/vendors.min.js') }}"></script>

{{-- Theme Scripts --}}
<script type="text/javascript" src="{{ asset('js/core/app-menu.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/core/app.js') }}"></script>

@if($configData['blankPage'] === false)
<script type="text/javascript" src="{{ asset('js/scripts/customizer.js') }}"></script>
@endif

{{-- user js --}}
<x-admin::scripts :files="[
    'js/messages.js',
]" />

<script type="text/javascript" src="{{ asset(mix('js/app.js')) }}"></script>

{{-- page script --}}
@yield('page-script')
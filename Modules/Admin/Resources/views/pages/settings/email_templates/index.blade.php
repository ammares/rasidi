@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.email_templates'))

@section('page-style')
<x-admin::table_grid.styles />
<x-admin::text_editor.styles />
@endsection

@section('actions')
<x-admin::header_actions>
    <a type="button" class="btn btn-primary" href="{{ route('settings.email_templates.create') }}">
        <i class="fa fa-plus mr-25"></i>
        <span class="align-middle">{{ __('global.new') }}</span>
    </a>
</x-admin::header_actions>
@endsection

@section('content')

<x-admin::email_templates.list category="client" />
<x-admin::email_templates.list category="staff" />


<div class="hide">
    <div class="error-mail-logs">
        <x-admin::email_templates.error_mail_logs />
    </div>

    <div class="success-mail-logs">
        <x-admin::email_templates.success_mail_logs />
    </div>
    <div class="send-test-email">
        <div class="row">
            <div class="col-12">
                <input type="email" class="form-control test-email" placeholder="{{__('global.email')}}" name="email"
                    value="" required>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')
<x-admin::table_grid.scripts />
<x-admin::text_editor.scripts />
<x-admin::scripts :files="[
        'js/custom/settings/email_templates/index.js',
        ]" />
@endsection
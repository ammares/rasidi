@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.users'))

@section('page-style')
<x-admin::table_grid.styles />
@endsection

@section('actions')
<x-admin::header_actions>
    <a type="button" class="btn btn-primary" href="javascript:void(0)" onclick="openUserForm()">
        <i class="fa fa-plus mr-25"></i>
        <span class="align-middle">{{ __('global.new') }}</span>
    </a>
</x-admin::header_actions>
@endsection

@section('content')

<x-admin::table_grid.table title="{{ __('global.desc_of_users_settings') }}" url="settings/users" grid-name="users"
    search-tooltip="{{ __('global.search_for_user_name_email') }}" filters="{{false}}" export="{{false}}"
    order='[1, "asc"]' />


<div class="hide">
    <div class="user-form">
        <x-admin::users.form :roles="$roles" />
    </div>
</div>

@endsection

@section('page-script')
<x-admin::table_grid.scripts />
<x-admin::scripts :files="[
        'js/custom/common/jquery.uploadPreview.min.js',
        'js/custom/common/image_preview.js',
        'js/custom/settings/users/index.js',
        'js/custom/common/custom_grid.js',
    ]" />
@endsection
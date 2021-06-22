@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.login_logs'))

@section('page-style')
<x-admin::table_grid.styles />
@endsection

@section('content')
<x-admin::table_grid.filters>
    <div class="row">
        <div class="col-md-6">
            <x-admin::table_grid.filter_text label="{{__('global.username')}}" column="login_logs.username"
                placeholder="{{__('global.username')}}" />
        </div>
        <div class="col-md-6">
            <x-admin::table_grid.filter_select label="{{__('global.role')}}" :options="$roles"
                column="role_id" />
        </div>
        <div class="col-md-6">
            <x-admin::table_grid.filter_select label="{{__('global.status')}}"
                :options="['Failed' => __('global.failed'), 'Banned' => __('global.banned'), 'Success' => __('global.success')]"
                column="login_logs.status" />
        </div>
        <div class="col-md-6">
            <x-admin::table_grid.filter_date label="{{__('global.login_date')}}" column="login_logs.created_at"
                placeholder="{{__('global.login_date')}}" />
        </div>
    </div>
</x-admin::table_grid.filters>
<x-admin::table_grid.table title="" url="reports\login_logs" grid-name="login_log"
    search-tooltip="{{ __('global.search_for_login_log') }}" order='[1, "desc"]' />
@endsection

@section('page-script')
<x-admin::table_grid.scripts />
<x-admin::scripts :files="[
        'js/custom/reports/login_logs/index.js',
        'js/custom/common/custom_grid.js',
    ]" />
@endsection
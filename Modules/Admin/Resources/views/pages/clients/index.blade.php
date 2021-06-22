@extends('admin::layouts/contentLayoutMaster')

@section('title', 'Clients')

@section('page-style')
<x-admin::table_grid.styles />
@endsection

@section('actions')
<x-admin::header_actions>
    <a type="button" class="btn btn-primary" href="javascript:void(0)">
        <span class="align-middle">{{ __('global.demand_requests') }}</span>
    </a>
</x-admin::header_actions>
@endsection

@section('content')
<x-admin::table_grid.filters>
    <div class="row">
        <div class="col-md-6">
            <x-admin::table_grid.filter_text label="{{__('global.first_name')}}" column="clients.first_name"
                placeholder="{{__('global.first_name')}}" />
        </div>
        <div class="col-md-6">
            <x-admin::table_grid.filter_text label="{{__('global.last_name')}}" column="clients.last_name"
                placeholder="{{__('global.last_name')}}" />
        </div>
        <div class="col-md-6">
            <x-admin::table_grid.filter_text label="{{__('global.email')}}" column="clients.email"
                placeholder="{{__('global.email')}}" />
        </div>
        <div class="col-md-6">
            <x-admin::table_grid.filter_text label="{{__('global.phone')}}" column="clients.mobile"
                placeholder="{{__('global.phone')}}" />
        </div>
        
        <div class="col-md-6">
            <x-admin::table_grid.filter_select label="{{__('global.verified?')}}"
                :options="[1 => __('global.verified'), 0 => __('global.not_verified')]"
                column="clients.email_verified" />
        </div>
        <div class="col-md-6">
            <x-admin::table_grid.filter_date label="{{__('global.registered_at')}}" column="clients.created_at"
                placeholder="{{__('global.registered_at')}}" />
        </div>
    </div>
</x-admin::table_grid.filters>

<x-admin::table_grid.table title="" url="clients" grid-name="clients"
    search-tooltip="{{ __('global.search_for_client_email') }}" order='[1, "asc"]'/>

<div class="hide">
    <div class="gateways-details">
        <x-admin::clients.gateway_details />
    </div>
    <div class="client-form">
        <x-admin::clients.form />
    </div>
    <div class="client-renew-subscription">
        <x-admin::clients.renew_subscription />
    </div>
</div>
@endsection

@section('page-script')
<x-admin::table_grid.scripts />
<x-admin::scripts :files="[
        'js/custom/clients/index.js',
        'js/custom/common/custom_grid.js',
    ]" />
@endsection
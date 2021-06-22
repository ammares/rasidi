@extends('admin::layouts/contentLayoutMaster')

@section('title', 'Contact Us Messages')

@section('page-style')
<x-admin::table_grid.styles />
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
            <x-admin::table_grid.filter_text label="{{__('global.subject')}}" column="contact_us.subject"
                placeholder="{{__('global.subject')}}" />
        </div>
        <div class="col-md-6">
            <x-admin::table_grid.filter_text label="{{__('global.message')}}" column="contact_us.message"
                placeholder="{{__('global.message')}}" />
        </div>
        <div class="col-md-6">
            <x-admin::table_grid.filter_date label="{{__('global.contacted_at')}}" column="contact_us.created_at"
                placeholder="{{__('global.contacted_at')}}" />
        </div>
    </div>
</x-admin::table_grid.filters>

<x-admin::table_grid.table title="{{ __('global.messages') }}" url="messages" grid-name="contact_us"
    search-tooltip="{{ __('global.search_for_name_subject') }}" order='[1, "desc"]'/>

{{--  Modals  --}}
<div id="message-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    </div>
</div>

<div class="hide">
    <div class="message-details">
        <x-admin::contact_us_messages.details />
    </div>
</div>

@endsection

@section('page-script')
<x-admin::table_grid.scripts />
<x-admin::scripts :files="[
        'js/custom/contact_us/index.js',
        'js/custom/common/custom_grid.js',
    ]" />
@endsection
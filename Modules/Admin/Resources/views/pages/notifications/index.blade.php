@extends('admin::layouts/contentLayoutMaster')

@section('title', 'Notifications')

@section('content')
<div class="card card-form card-red">
    <div class="card-header">
        <div class="btn-group ml-auto" role="group">
            <button class="btn btn-link text-danger" @if($count==0) disabled @endif type="button"
                onclick="deleteAllNotification()">
                <span class="fa fa-trash"></span> {{__('global.clear_all')}}
            </button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-nowrap">
            <thead>
                <tr>
                    <th></th>
                    <th>{{__('global.date')}}</th>
                    <th>{{__('global.message')}}</th>
                </tr>
            </thead>
            <tbody>
                @if (count($notifications)>0)
                @foreach($notifications as $notification)
                <tr>
                    <td>
                        <button onclick="deleteNotification('{{$notification->id}}')" class="btn btn-link text-danger"
                            data-toggle="tooltip" data-placement="bottom" title="{{__('delete')}}">
                            <i class="fa fa-times"></i>
                        </button>
                    </td>
                    <td>{{ $notification->created_at->format('d-m-Y H:j A') }}</td>
                    <td>
                        {{isset($notification->data['message'])?$notification->data['message']:'-'}}
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="3">
                        <x-admin::no_data_to_display />
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    @if (count($notifications)>0)
    <div class="card-footer">
        <div class="col-md-6">
            {{__('global.showing')}} {{($notifications->currentpage()-1)*$notifications->perpage()+1}}
            {{__('global.to')}}
            {{ ($notifications->currentpage()*$notifications->perpage()) > $notifications->total() ? $notifications->total() : $notifications->currentpage()*$notifications->perpage() }}
            {{__('global.of')}} {{$notifications->total()}} {{__('global.entries')}}
        </div>
        <div class="col-md-6 pull-right">{{ $notifications->links() }}</div>
    </div>
    @endif
</div>
{{--    <div class="card">--}}
{{--        <div class="card-header">--}}
{{--            <div class="btn-group ml-auto" role="group">--}}
{{--                <button class="btn btn-outline-danger" @if($count==0) disabled--}}
{{--                        @endif type="button" onclick="deleteAllNotification()">--}}
{{--                    <span class="fa fa-trash"></span> Delete All--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        @if($count==0)--}}
{{--            <div class="text-center p-3">--}}
{{--                <span class="text-center m-3">No Notifications</span>--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <table class="table">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>Message</th>--}}
{{--                    <th>Action By</th>--}}
{{--                    <th>Created At</th>--}}
{{--                    <th>Action</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach($notifications as $notification)--}}
{{--                    <tr>--}}
{{--                        <td>{{isset($notification->data['message'])?$notification->data['message']:'-'}}</td>--}}
{{--                        <td>{{isset($notification->data['user_data']['name'] )?$notification->data['user_data']['name']:'-'}}
</td>--}}
{{--                        <td>{{$notification->created_at}}</td>--}}
{{--                        <td class="text-center"><a href="javascript:;"--}}
{{--                                                   onclick="deleteNotification('{{$notification->id}}',this)"--}}
{{--                                                   class="fa fa-trash"></a></td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        @endif--}}
{{--    </div>--}}
@endsection

@section('page-script')
<x-admin::scripts :files="[
        'js/custom/notifications/index.js',
    ]" />
@endsection
@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.roles_and_permissions'))

@section('actions')
<x-admin::header_actions>
    <a type="button" class="btn btn-primary waves-effect waves-float waves-light" href="{{route('settings.roles.create')}}">
        <i class="fa fa-plus mr-25"></i>
        <span class="align-middle">{{ __('global.new') }}</span>
    </a>
</x-admin>
@endsection

@section('content')
<div class="card card-form card-red">
    <div class="card-body table-responsive">
        <table class="table table-nowrap">
            <thead>
                <tr>
                    <th></th>
                    <th>{{__('global.role')}}</th>
                    <th>{{__('global.description')}}</th>
                    <th>{{__('global.users')}}</th>
                </tr>
            </thead>
            <tbody class="if-empty">
                @if (count($roles)>0)
                @foreach($roles as $role)
                <tr data-id="{{$role->id}}">
                    <td>
                        <div class="dropdown mr-25">
                            <button type="button"
                                class="btn btn-icon btn-flat-primary waves-effect dropdown-toggle hide-arrow"
                                data-toggle="dropdown">
                                <i class="fa fa-bars"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('settings.roles.edit',[$role->id]) }}">
                                    <i data-feather="edit-2" class="mr-50"></i>
                                    <span>{{ __('global.edit') }}</span>
                                </a>
                                <a class="dropdown-item" onclick="deleteRole({{$role->id}})">
                                    <i data-feather="trash" class="mr-50"></i>
                                    <span>{{ __('global.delete') }}</span>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td>{{ Str::of($role->name)->replace('_', ' ') }}</td>
                    <td>{{ $role->description }}</td>
                    <td>{{ $role->users()->count() }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4">
                        <x-admin::no_data_to_display />
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    @if (count($roles)>0)
    <div class="card-footer">
        <div class="col-md-6">
            {{__('global.showing')}} {{($roles->currentpage()-1)*$roles->perpage()+1}}
            {{__('global.to')}}
            {{ ($roles->currentpage()*$roles->perpage()) > $roles->total() ? $roles->total() : $roles->currentpage()*$roles->perpage() }}
            {{__('global.of')}} {{$roles->total()}} {{__('global.entries')}}
        </div>
        <div class="col-md-6 pull-right">{{ $roles->links() }}</div>
    </div>
    @endif
</div>
@endsection

@section('page-script')
<x-admin::scripts :files="[
    'js/custom/settings/roles/index.js',
]" />
@endsection
@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.introductions'))

@section('page-style')
<x-admin::styles :files="[
        'vendors/css/extensions/dragula.min.css',
        'css/base/plugins/extensions/ext-component-drag-drop.css'
    ]" />
@endsection

@section('content')

@section('actions')
<x-admin::header_actions>
    <a type="button" class="btn btn-primary" href="{{ route('settings.introductions.create') }}">
        <i class="fa fa-plus mr-25"></i>
        <span class="align-middle">{{ __('global.new') }}</span>
    </a>
</x-admin::header_actions>
@endsection

<div class="d-flex justify-content-between align-items-center">
    <p>{{ __('global.desc_of_introduction_settings') }}</p>
</div>

<section id="sortable-lists">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">
                        <div class="d-flex align-items-center">
                            <p class="mr-auto">{{ __('global.reorder_list_hint') }}</p>
                            <x-admin::grid_lang_dropdown grid-lang="{{$grid_lang}}" />
                        </div>
                    </p>
                    <ul class="list-group" id="introductions">
                        @if (count($introductions)>0)
                        @foreach ($introductions as $key => $introduction )
                        <li class="list-group-item draggable" data-id='{{ $introduction['id'] }}'>
                            <div class="media d-flex align-items-center">
                                <div class="dropdown mr-25">
                                    <button type="button"
                                        class="btn btn-icon btn-flat-primary waves-effect dropdown-toggle hide-arrow"
                                        data-toggle="dropdown">
                                        <i class="fa fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ route('settings.introductions.edit', $introduction['id'])  }}">
                                            <i data-feather="edit-2" class="mr-50"></i>
                                            <span>{{ __('global.edit') }}</span>
                                        </a>
                                        <a class="dropdown-item"
                                            onclick="deleteIntroduction({{ $introduction['id'] }})">
                                            <i data-feather="trash" class="mr-50"></i>
                                            <span>{{ __('global.delete') }}</span>
                                        </a>
                                    </div>
                                </div>
                                <img src="{{$introduction->image ? asset('storage/introductions/thumbnail/' . $introduction->image) : asset('images/custom/no_image.png')}}"
                                    class="rounded-circle mr-2" alt="img-placeholder" height="70" width="70" />
                                <div class="media-body">
                                    <h5 class="mt-1">{!! $introduction->{'title:'.$grid_lang} !!}</h5>
                                    <span>{!! $introduction->{'summary:'.$grid_lang} !!}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        @else
                        <li class="list-group-item">
                            <div class="no-data-to-display">
                                <i class="fa fa-exclamation-triangle mb-2"></i>
                                <br>
                                {{__('global.no_data_to_display')}}
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="deleteIntroduction-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('global.confirm') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <h5 class="font-weight-normal">{{ __('global.are_you_sure_to_delete_this_item') }}</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-confirm" data-dismiss="modal">
                    {{__('global.delete')}}
                </button>
                <button type="button" class="btn btn-link text-secondary" data-dismiss="modal">
                    {{__('global.cancel')}}
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')
<x-admin::scripts :files="[
        'vendors/js/extensions/dragula.min.js',
        'js/custom/settings/introductions/index.js',
    ]" />
@endsection
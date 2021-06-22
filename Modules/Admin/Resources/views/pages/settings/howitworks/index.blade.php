@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.how_it_works'))

@section('page-style')
<x-admin::styles :files="[
        'vendors/css/extensions/dragula.min.css',
        'css/base/plugins/extensions/ext-component-drag-drop.css'
    ]" />
@endsection

@section('content')

@section('actions')
<x-admin::header_actions>
    <a type="button" class="btn btn-primary" href="{{ route('settings.howitworks.create') }}">
        <i class="fa fa-plus mr-25"></i>
        <span class="align-middle">{{ __('global.new') }}</span>
    </a>
</x-admin::header_actions>
@endsection

<div class="d-flex justify-content-between align-items-center">
    <p>{{ __('global.desc_of_how_it_works_settings') }}</p>
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
                    <ul class="list-group" id="howitworks">
                        @if (count($howitworks)>0)
                        @foreach ($howitworks as $key => $howitwork )
                        <li class="list-group-item draggable" data-id='{{ $howitwork['id'] }}'>
                            <div class="media d-flex align-items-center">
                                <div class="dropdown mr-25">
                                    <button type="button"
                                        class="btn btn-icon btn-flat-primary waves-effect dropdown-toggle hide-arrow"
                                        data-toggle="dropdown">
                                        <i class="fa fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ route('settings.howitworks.edit', $howitwork['id'])  }}">
                                            <i data-feather="edit-2" class="mr-50"></i>
                                            <span>{{ __('global.edit') }}</span>
                                        </a>
                                        <a class="dropdown-item" onclick="deleteHowitworks({{ $howitwork['id'] }})">
                                            <i data-feather="trash" class="mr-50"></i>
                                            <span>{{ __('global.delete') }}</span>
                                        </a>
                                    </div>
                                </div>
                                <img src="{{$howitwork->image ? asset('storage/howitworks/' . $howitwork->image) : asset('images/custom/no_image.png')}}"
                                    class="rounded-circle mr-2" alt="img-placeholder" height="70" width="70" />
                                <div class="media-body">
                                    <h5 class="mt-1">{!! $howitwork->{'title:'.$grid_lang} !!}</h5>
                                    <span>{!! $howitwork->{'summary:'.$grid_lang} !!}</span>
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

@endsection

@section('page-script')
<x-admin::scripts :files="[
        'vendors/js/extensions/dragula.min.js',
        'js/custom/settings/howitworks/index.js',
    ]" />
@endsection
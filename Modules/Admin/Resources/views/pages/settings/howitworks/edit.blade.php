@extends('admin::layouts/contentLayoutMaster')

@section('title', 'Edit '.__('global.how_it_works'))

@section('page-style')
<x-admin::text_editor.styles />
@endsection

@section('content')

<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="form quill-form needs-validation was-validated" method="POST"
                        enctype="multipart/form-data"
                        action="{{ route('settings.howitworks.update', $howitwork['id']) }}">
                        <input name="_method" type="hidden" value="PATCH">
                        @csrf
                        <x-admin::howitworks_keyfeatures.form :introduction="$howitwork" :type="$howitwork['type']" />
                        @if ($errors->any())
                        <div class="text-danger row">
                            <div class="col-12">
                                {{ __('Whoops! Something went wrong.') }}
                            </div>
                            <div class="col-12">
                                <ul class="mt-1">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                    </form>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary mr-1 save-btn">{{__('global.save')}}</button>
                        <a type="reset" class="btn btn-outline-secondary"
                            href="{{route('settings.howitworks')}}">{{__('global.cancel')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page-script')
<x-admin::text_editor.scripts />
<x-admin::scripts :files="[
        'js/custom/common/jquery.uploadPreview.min.js',
        'js/custom/common/image_preview.js',
    ]" />
@endsection
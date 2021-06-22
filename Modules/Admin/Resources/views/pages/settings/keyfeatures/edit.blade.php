@extends('admin::layouts/contentLayoutMaster')

@section('title', 'Edit '.__('global.key_feature'))

@section('page-style')
<x-admin::styles :files="[
        'vendors/css/editors/quill/katex.min.css',
        'vendors/css/editors/quill/monokai-sublime.min.css',
        'vendors/css/editors/quill/quill.snow.css',
        'vendors/css/editors/quill/quill.bubble.css',
        'css/base/plugins/forms/form-quill-editor.css'
    ]" />
@endsection

@section('content')

<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="form quill-form needs-validation was-validated" method="POST"
                        enctype="multipart/form-data"
                        action="{{ route('settings.keyfeatures.update', $keyfeature['id']) }}">
                        <input name="_method" type="hidden" value="PATCH">
                        @csrf
                        <x-admin::howitworks_keyfeatures.form :introduction="$keyfeature" :type="$keyfeature['type']" />
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
                            href="{{route('settings.keyfeatures')}}">{{__('global.cancel')}}</a>
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
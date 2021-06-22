@extends('admin::layouts/contentLayoutMaster')

@section('title', 'New '.__('global.key_feature'))

@section('page-style')
<x-admin::text_editor.styles />
@endsection

@section('content')

<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="form quill-form needs-validation" method="POST"
                        action="{{ route('settings.keyfeatures.store') }}" enctype="multipart/form-data">
                        @csrf
                        <x-admin::howitworks_keyfeatures.form :type="$type" />
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
<x-admin::text_editor.text_editor.scripts />
<x-admin::scripts :files="[
        'js/custom/common/jquery.uploadPreview.min.js',
        'js/custom/common/image_preview.js',
    ]" />
@endsection
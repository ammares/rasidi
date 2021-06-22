@extends('admin::layouts/contentLayoutMaster')

@section('title',__('global.new') .' '. __('global.email_template') )

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
                    <form class="form quill-form needs-validation" method="POST"
                        action="{{ route('settings.email_templates.store') }}">
                        @csrf
                        <x-admin::email_templates.form />
                        <div class="col-12">
                            <button type="button" class="btn btn-primary mr-1 save-btn">
                                {{__('global.save')}}
                            </button>
                            <a type="reset" class="btn btn-outline-secondary"
                                href="{{route('settings.email_templates')}}">{{__('global.cancel')}}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page-script')
<x-admin::text_editor.scripts />
@endsection
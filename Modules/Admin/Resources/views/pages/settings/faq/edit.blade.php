@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.edit_faq'))

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
                        action="{{ route('settings.faq.update',$faq['id']) }}">
                        <input name="_method" type="hidden" value="PATCH">
                        @csrf
                        <x-admin::faq.form :faq="$faq" />
                    </form>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary mr-1 save-btn">{{__('global.save')}}</button>
                        <a type="reset" class="btn btn-outline-secondary"
                            href="{{route('settings.faq')}}">{{__('global.cancel')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page-script')
<x-admin::text_editor.scripts />
@endsection
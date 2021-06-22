@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.business_profile'))

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
<div class="d-block mb-3">
    <p>{{__('global.business_profile_pages_help1')}}</p>
    <p>{{__('global.business_profile_pages_help2')}}</p>
    <p>{{__('global.business_profile_pages_help3')}}</p>
</div>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="form" method="POST" action="{{ route('settings.business_profiles.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">

                                <div class="row justify-content-between">
                                    <div class="col-6 form-group">
                                        <div class="row">
                                            <div class="col-12 mt-1">
                                                <p class="text-muted">{{__('global.business_profile_info')}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mt-1">
                                                <h6 for="business-name" class="image-label">
                                                    {{__('global.business_name')}}</h6>
                                                <input id="business-name" type="text" class="form-control"
                                                    autocomplete="off" name="business_name"
                                                    value="{{ old('business_name', $business_profile_pages['business_name'][0]['value'] ?? null) }}">
                                            </div>
                                            <div class="col-12 mt-1">
                                                <h6 for="business-email" class="image-label">{{__('global.email')}}</h6>
                                                <input id="business-email" type="text" class="form-control"
                                                    autocomplete="off" name="business_email"
                                                    value="{{ old('business_email', $business_profile_pages['business_email'][0]['value'] ?? null) }}">
                                            </div>
                                            <div class="col-12 mt-1">
                                                <h6 for="business-phone" class="image-label">{{__('global.phone')}}</h6>
                                                <input id="business-phone" type="text" class="form-control"
                                                    autocomplete="off" name="business_phone"
                                                    value="{{ old('business_phone', $business_profile_pages['business_phone'][0]['value'] ?? null) }}">
                                            </div>
                                            <div class="col-12 mt-1">
                                                <h6 for="business-facebook" class="image-label">
                                                    {{__('global.facebook')}}</h6>
                                                <input id="business-facebook" type="text" class="form-control"
                                                    autocomplete="off" name="business_facebook"
                                                    value="{{ old('business_facebook', $business_profile_pages['business_facebook'][0]['value'] ?? null) }}">

                                            </div>
                                            <div class="col-12 mt-1">
                                                <h6 for="business-twitter" class="image-label">{{__('global.twitter')}}
                                                </h6>
                                                <input id="business-twitter" type="text" class="form-control"
                                                    autocomplete="off" name="business_twitter"
                                                    value="{{ old('business_twitter', $business_profile_pages['business_twitter'][0]['value'] ?? null) }}">
                                            </div>
                                            <div class="col-12 mt-1">
                                                <h6 for="business-linkedin" class="image-label">
                                                    {{__('global.linkedin')}}</h6>
                                                <input id="business-linkedin" type="text" class="form-control"
                                                    autocomplete="off" name="business_linkedin"
                                                    value="{{ old('business_linkedin', $business_profile_pages['business_linkedin'][0]['value'] ?? null) }}">
                                            </div>
                                            <div class="col-12 mt-1">
                                                <h6 for="business-instagram" class="image-label">
                                                    {{__('global.instagram')}}</h6>
                                                <input id="business-instagram" type="text" class="form-control"
                                                    autocomplete="off" name="business_instagram"
                                                    value="{{ old('business_instagram', $business_profile_pages['business_instagram'][0]['value'] ?? null) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 image-preview-input text-center">
                                        <div class="form-group">
                                            <h6 for="logo">
                                                {{__('global.logo')}}
                                            </h6>
                                            @if(isset($business_profile_pages['business_logo']) &&
                                            $business_profile_pages['business_logo'][0]['value'])
                                            <div id="business-logo-preview" class="image-preview"
                                                style="background-image: url({{ asset('storage/system_preferences/' . $business_profile_pages['business_logo'][0]['value']) }});
                                                        background-size: cover; background-position: center center; width: auto">
                                                <h6 id="business-logo-label" class="image-label">
                                                    {{__('global.change_image')}}</h6>
                                                <input id="business-logo-image" type="file" class="image-upload"
                                                    name="business_logo">
                                            </div>
                                            @else
                                            <div id="business-logo-preview" class="image-preview" style="width: auto">
                                                <h6 id="business-logo-label" class="image-label">
                                                    {{__('global.choose_image')}}</h6>
                                                <input id="business-logo-image" type="file" class="image-upload"
                                                    name="business_logo">
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary mr-1 save-btn">{{__('global.save')}}</button>
                            <a type="reset" class="btn btn-outline-secondary"
                                href="{{route('settings')}}">{{__('global.cancel')}}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page-script')
<x-admin::scripts :files="[
        'js/custom/common/jquery.uploadPreview.min.js',
        'js/custom/settings/business_profile/index.js',
    ]" />
@endsection
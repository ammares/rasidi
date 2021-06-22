@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.legal_pages'))

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
    <p>{{__('global.legal_pages_help1')}}</p>
    <p>{{__('global.legal_pages_help2')}}</p>
    <p>{{__('global.legal_pages_help3')}}</p>
</div>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="form quill-form" method="POST" action="{{ route('settings.legal.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <ul class="nav nav-tabs" role="tablist">
                                            @foreach (config('translatable.locales') as $key => $locale)
                                            <li class="nav-item">
                                                <a class="nav-link {{$loop->first ? 'active show':''}}"
                                                    data-toggle="tab" href="#tabs-{{ $key }}"
                                                    role="tab">{{ __('global.'.$locale) }}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content">
                                            @foreach (config('translatable.locales') as $key => $locale)
                                            <div class="tab-pane fade {{$loop->first ? 'show active':''}}"
                                                role="tabpanel" data-lang="{{ $locale }}" id="tabs-{{ $key }}">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h4 class="card-title">
                                                                    {{ __('global.term_of_use') }}
                                                                </h4>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="quill-editor"
                                                                    data-field="term-of-use-{{$locale}}">
                                                                    {!!
                                                                    $legal_pages['term_of_use_'.$locale][0]['value'] ??
                                                                    ''
                                                                    !!}
                                                                </div>
                                                                <textarea class="term-of-use-{{$locale}} hide"
                                                                    name="term_of_use_{{ $locale }}">  </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h4 class="card-title">
                                                                    {{ __('global.privacy_policy') }}
                                                                </h4>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="quill-editor"
                                                                    data-field="privacy-policy-{{$locale}}">
                                                                    {!!
                                                                    $legal_pages['privacy_policy_'.$locale][0]['value']
                                                                    ?? ''
                                                                    !!}
                                                                </div>
                                                                <textarea class="privacy-policy-{{$locale}} hide"
                                                                    name="privacy_policy_{{ $locale }}">  </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary mr-1 save-btn">{{__('global.save')}}</button>
                        <a type="reset" class="btn btn-outline-secondary"
                            href="{{route('settings')}}">{{__('global.cancel')}}</a>
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
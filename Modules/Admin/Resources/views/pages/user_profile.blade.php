@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.user_profile'))

@section('page-style')
<x-admin::styles :files="[
        'css/base/plugins/forms/pickers/form-pickadate.css',
        'css/base/plugins/forms/pickers/form-flat-pickr.css',
        'css/base/plugins/forms/form-validation.css',
    ]" />
@endsection
@section('content')
<section id="page-account-settings">
    <div class="row">

        <!-- left menu section -->
        <div class="col-3 col-md-4 mb-2 mb-md-0">
            <ul class="nav nav-pills flex-column nav-left">
                <li class="nav-item">
                    <a class="nav-link active" id="account-pill-general" data-toggle="pill"
                        href="#account-vertical-general" aria-expanded="true">
                        <i data-feather="user" class="font-medium-3 mr-1"></i>
                        <span class="font-weight-bold">{{ __('global.general') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="account-pill-password" data-toggle="pill" href="#account-vertical-password"
                        aria-expanded="false">
                        <i data-feather="lock" class="font-medium-3 mr-1"></i>
                        <span class="font-weight-bold">{{ __('global.change_password') }}</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- right content section -->
        <div class="col-9 col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                            aria-labelledby="account-pill-general" aria-expanded="true">

                            <form class="validate-form needs-validation was-validated mt-2" method="POST"
                                enctype="multipart/form-data" action="{{ route('user_profile.update') }}">
                                @csrf
                                <input type="hidden" value="PATCH" name="_method" />
                                <div class="row">
                                    <div class="media col-12 mb-2">
                                        <a href="javascript:void(0);" class="mr-25">
                                            <img src="{{ (Auth::user()->avatar && Auth::user()->avatar != 'user_silhouette.png') ? asset('storage/avatars/thumbnail/' . Auth::user()->avatar) : asset('images/custom/user_silhouette.png')}}"
                                                class="account-upload-img rounded mr-50" alt="profile image"
                                                height="200" width="200" />
                                        </a>
                                        <div class="media-body mt-75 ml-1">
                                            <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">
                                                {{ __('global.upload') }}
                                            </label>
                                            <input type="file" class="account-upload" hidden accept="image/*"
                                                name="avatar" />
                                            <p>{{ __('global.allowed_extensin_and_size_pic') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-9">
                                        <div class="form-group">
                                            <h6 for="account-name">{{ __('global.name') }}</h6>
                                            <input type="text" class="form-control" id="account-name" name="name"
                                                placeholder="{{ __('global.name') }}" value="{{ Auth::user()->name }}"
                                                required />
                                        </div>
                                        <div class="form-group">
                                            <lh6abel for="account-e-mail">{{ __('global.email') }}</h6>
                                                <input type="email" class="form-control" id="account-e-mail"
                                                    name="email" placeholder="{{ __('global.email') }}"
                                                    value="{{ Auth::user()->email }}" required />
                                        </div>
                                        <div class="form-group">
                                            <h6 for="mobile">{{ __('global.phone') }}</h6>
                                            <input type="text" class="form-control" id="mobile" name="mobile"
                                                placeholder="{{ __('global.phone') }}"
                                                value="{{ Auth::user()->mobile }}" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mt-2 mr-1">
                                            {{ __('global.save_changes') }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <div class="tab-pane fade" id="account-vertical-password" role="tabpanel"
                            aria-labelledby="account-pill-password" aria-expanded="false">

                            <form class="validate-form needs-validation" method="POST"
                                action="{{ route('user_profile.change_password') }}">
                                @csrf
                                <input type="hidden" value="PATCH" name="_method" />
                                <div class="row">
                                    <div class="col-12 col-sm-9">
                                        <div class="form-group">
                                            <h6 for="account-old-password">{{ __('global.current_password') }}</h6>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" class="form-control" id="account-old-password"
                                                    name="current_password"
                                                    placeholder="{{ __('global.old_password') }}" required />
                                                <div class="input-group-append">
                                                    <div class="input-group-text cursor-pointer">
                                                        <i data-feather="eye"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-9">
                                        <div class="form-group">
                                            <h6 for="account-new-password">{{ __('global.new_password') }}</h6>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" id="account-new-password" name="new_password"
                                                    class="form-control" placeholder="{{ __('global.new_password') }}"
                                                    required />
                                                <div class="input-group-append">
                                                    <div class="input-group-text cursor-pointer">
                                                        <i data-feather="eye"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">{{ __('global.password_hint') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-9">
                                        <div class="form-group">
                                            <h6 for="account-retype-new-password">
                                                {{  __('global.retry_new_password')  }}</h6>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" class="form-control"
                                                    id="account-retype-new-password" name="new_password_confirmation"
                                                    placeholder="{{ __('global.new_password') }}" required />
                                                <div class="input-group-append">
                                                    <div class="input-group-text cursor-pointer">
                                                        <i data-feather="eye"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mr-1 mt-1">
                                            {{ __('global.save_changes') }}
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page-script')
<x-admin::scripts :files="[
    'vendors/js/forms/validation/jquery.validate.min.js',
    'js/custom/settings/users/profile.js',
]" />
@endsection
@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.email_settings'))

@section('content')
<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="form needs-validation" method="POST"
                        action="{{ route('settings.general.email_settings.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="col-12 pt-1">
                                    <p class="text-muted">
                                        {{__('global.desc_of_email_settings')}}
                                    </p>
                                </div>
                                <div class="col-12 form-group mt-1">
                                    <h6>
                                        {{__('global.email_mailer')}}
                                    </h6>
                                    <input type="text" class="form-control" autocomplete="off" name="email_mailer"
                                        value="{{ $email_settings['email_mailer'][0]['value'] ?? ''}}"
                                        placeholder="smtp" />
                                </div>
                                <div class="col-12 form-group mt-1">
                                    <h6>
                                        {{__('global.email_server_host')}}
                                    </h6>
                                    <input type="text" class="form-control" autocomplete="off" name="email_server_host"
                                        value="{{ $email_settings['email_server_host'][0]['value'] ?? ''}}"
                                        placeholder="mailhog" />
                                </div>
                                <div class="col-12 mt-1">
                                    <h6>
                                        {{__('global.email_server_port')}}
                                    </h6>
                                    <input type="number" class="form-control" autocomplete="off"
                                        name="email_server_port"
                                        value="{{ $email_settings['email_server_port'][0]['value'] ?? ''}}"
                                        placeholder="465, 1025" />
                                </div>
                                <div class="col-12 form-group mt-1">
                                    <h6>
                                        {{__('global.username')}}
                                    </h6>
                                    <input type="text" class="form-control" autocomplete="off" name="email_username"
                                        value="{{ $email_settings['email_username'][0]['value'] ?? ''}}"
                                        placeholder="noreply@business-domain.com" />
                                </div>
                                <div class="col-12 form-group mt-1">
                                    <h6>
                                        {{__('global.password')}}
                                    </h6>
                                    <input type="text" class="form-control" autocomplete="off" name="email_password"
                                        value="{{ $email_settings['email_password'][0]['value'] ?? ''}}" />
                                </div>
                                <div class="col-12 form-group mt-1">
                                    <h6>
                                        {{__('global.email_encryption')}}</h6>
                                    <input type="text" class="form-control" autocomplete="off" name="email_encryption"
                                        value="{{ $email_settings['email_encryption'][0]['value'] ?? ''}}"
                                        placeholder="SSL or TLS" />
                                </div>
                                <div class="col-12 form-group mt-1">
                                    <h6>
                                        {{__('global.email_from_address')}}
                                    </h6>
                                    <input type="text" class="form-control" autocomplete="off" name="email_from_address"
                                        value="{{ $email_settings['email_from_address'][0]['value'] ?? ''}}"
                                        placeholder="support@business-domain.com" />
                                </div>
                                <div class="col-12 form-group mt-1">
                                    <h6>
                                        {{__('global.email_from_name')}}
                                    </h6>
                                    <input type="text" class="form-control" autocomplete="off" name="email_from_name"
                                        value="{{ $email_settings['email_from_name'][0]['value'] ?? ''}}"
                                        placeholder="business name" />
                                </div>
                            </div>
                            <div class="col-12 mt-2 ml-1">
                                <button type="submit"
                                    class="btn btn-primary mr-1 save-btn">{{__('global.save')}}</button>
                                <a type="reset" class="btn btn-outline-secondary"
                                    href="{{route('settings.general')}}">{{__('global.cancel')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
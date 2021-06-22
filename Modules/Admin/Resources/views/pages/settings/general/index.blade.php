@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.gereral_settings'))

@section('content')

<div class="row settings-list">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('settings.general.email_settings') }}">
          <h4 class="card-title">
            <i class="fa fa-envelope fa-lg"></i> {{ __('global.email_settings') }}
          </h4>
        </a>
      </div>
      <div class="card-body">
        <div class="card-text">
          <p>
            {{ __('global.desc_of_email_settings') }}
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
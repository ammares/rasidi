@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.reports'))

@section('content')

<div class="row settings-list">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('reports.login_logs') }}">
          <h4 class="card-title">
            <i class="fa fa-eye fa-lg"></i> {{ __('global.login_logs') }}
          </h4>
        </a>
      </div>
      <div class="card-body">
        <div class="card-text">
          <p>
            {{ __('global.desc_of_login_logs') }}
          </p>
        </div>
      </div>
    </div>
  </div>  
</div>

@endsection
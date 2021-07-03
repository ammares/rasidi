@extends('admin::layouts/contentLayoutMaster')

@section('title', 'Settings')

@section('content')

<div class="row settings-list">
  <!-- <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('settings.general') }}">
          <h4 class="card-title">
            <i class="fa fa-cogs fa-lg"></i> {{ __('global.general') }}
          </h4>
        </a>
      </div>
      <div class="card-body">
        <div class="card-text">
          <p>
            {{ __('global.desc_of_general_settings') }}
          </p>
        </div>
      </div>
    </div>
  </div> -->

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('settings.users') }}">
          <h4 class="card-title">
            <i class="fa fa-users fa-lg"></i> {{ __('global.users') }}
          </h4>
        </a>
      </div>
      <div class="card-body">
        <div class="card-text">
          <p>
            {{ __('global.desc_of_users_settings') }}
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('settings.roles') }}">
          <h4 class="card-title">
            <i class="fa fa-user-cog fa-lg"></i> {{ __('global.roles_and_permissions') }}
          </h4>
        </a>
      </div>
      <div class="card-body">
        <div class="card-text">
          <p>
            {{ __('global.desc_of_roles_and_permissions_settings') }}
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('settings.categories') }}">
          <h4 class="card-title">
            <i class="fa fa-file-alt fa-lg"></i> {{ __('global.recharge_categories') }}
          </h4>
        </a>
      </div>
      <div class="card-body">
        <div class="card-text">
          <p>
            Show, edit and add recharge
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('settings.transfer_operations') }}">
          <h4 class="card-title">
            <i class="fa fa-file-invoice-dollar  fa-lg"></i> {{ __('global.transfer_operations') }}
          </h4>
        </a>
      </div>
      <div class="card-body">
        <div class="card-text">
          <p>
            Show all transfer operations to clients
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <a href="">
          <h4 class="card-title">
            <i class="fa fa-hand-holding-usd fa-lg"></i> Charge Operations
          </h4>
        </a>
      </div>
      <div class="card-body">
        <div class="card-text">
          <p>
            Show and add charge operations to clients
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <a href="">
          <h4 class="card-title">
            <i class="fa fa-donate fa-lg"></i> Clients Bills
          </h4>
        </a>
      </div>
      <div class="card-body">
        <div class="card-text">
          <p>
            Show, import and export all clients bills
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('settings.email_templates') }}">
          <h4 class="card-title">
            <i class="fa fa-envelope-open fa-lg"></i> {{ __('global.email_template') }}
          </h4>
        </a>
      </div>
      <div class="card-body">
        <div class="card-text">
          <p>
            {{ __('global.desc_of_email_template_settings') }}
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('settings.legal') }}">
          <h4 class="card-title">
            <i class="fa fa-copy fa-lg"></i> {{ __('global.legal') }}
          </h4>
        </a>
      </div>
      <div class="card-body">
        <div class="card-text">
          <p>
            {{ __('global.desc_of_legal_settings') }}
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('settings.introductions') }}">
          <h4 class="card-title">
            <i class="fa fa-image fa-lg"></i> {{ __('global.introductions') }}
          </h4>
        </a>
      </div>
      <div class="card-body">
        <div class="card-text">
          <p>
            {{ __('global.desc_of_introduction_settings') }}
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('settings.howitworks') }}">
          <h4 class="card-title">
            <i class="fa fa-th-list fa-lg"></i> {{ __('global.how_it_works') }}
          </h4>
        </a>
      </div>
      <div class="card-body">
        <div class="card-text">
          <p>
            {{ __('global.desc_of_how_it_works_settings') }}
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('settings.keyfeatures') }}">
          <h4 class="card-title">
            <i class="fa fa-briefcase fa-lg"></i> {{ __('global.key_features') }}
          </h4>
        </a>
      </div>
      <div class="card-body">
        <div class="card-text">
          <p>
            {{ __('global.desc_of_key_features_settings') }}
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('settings.faq') }}">
          <h4 class="card-title">
            <i class="fa fa-question-circle fa-lg"></i> {{ __('global.faq') }}
          </h4>
        </a>
      </div>
      <div class="card-body">
        <div class="card-text">
          <p>
            {{ __('global.desc_of_faq_settings') }}
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('settings.business_profiles') }}">
          <h4 class="card-title">
            <i class="fa fa-industry fa-lg"></i> {{ __('global.business_profile') }}
          </h4>
        </a>
      </div>
      <div class="card-body">
        <div class="card-text">
          <p>
            {{ __('global.business_profile_desc') }}
          </p>
        </div>
      </div>
    </div>
  </div> -->
</div>

@endsection

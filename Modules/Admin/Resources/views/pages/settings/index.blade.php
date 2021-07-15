@extends('admin::layouts/contentLayoutMaster')

@section('title', 'Settings')

@section('content')

<div class="row settings-list">

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
        <a href="{{ route('settings.charge_operations') }}">
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
        <a href="{{ route('settings.clients_bills') }}">
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

  
</div>

@endsection

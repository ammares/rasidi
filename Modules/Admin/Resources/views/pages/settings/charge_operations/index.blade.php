@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.charge_operations'))

@section('page-style')
<x-admin::table_grid.styles />
@endsection

@section('actions')
<x-admin::header_actions>
    <a type="button" class="btn btn-primary"
    href="javascript:;" onclick="addChargeOperation()">
        <i class="fa fa-plus mr-25"></i>
        <span class="align-middle">{{ __('global.new') }}</span>
    </a>
</x-admin::header_actions>
@endsection

@section('content')

<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-charge-operations table">
                        <thead>
                            <tr>
                                <th></th>
                                <th> {{ __('global.user') }}</th>
                                <th> {{ __('global.client') }}</th>
                                <th> {{ __('global.mobile') }}</th>
                                <th> {{ __('global.amount') }}</th>
                                <th> {{ __('global.created_at') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="hide">
    <div class="charge-operation-form">
      <form method="POST" enctype="multipart/form-data" class="needs-validation">
        <div class="row">
            <div class="col-md-12">
                <div class="col-12">
                    <h6 for="client_id">{{ __('global.client') }}</h6>
                    <div class="input-group">
                        <select class="form-control">
                          @foreach ($clients as $client)
                            <option value="{{$client['id']}}">
                              {{$client['first_name'].' '.$client['last_name'].', '.$client['mobile']}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 mt-1">
                    <h6 for="amount">{{ __('global.amount') }}</h6>
                    <div class="input-group">
                        <input type="number" name="amount" class="form-control" required>
                    </div>
                </div>
              </div>
        </div>
      </form>
    </div>
</div>

@endsection

@section('page-script')
<x-admin::table_grid.scripts />
<x-admin::scripts :files="[
        'vendors/js/extensions/dragula.min.js',
        'js/custom/settings/charge_operations/index.js',
    ]" />
@endsection

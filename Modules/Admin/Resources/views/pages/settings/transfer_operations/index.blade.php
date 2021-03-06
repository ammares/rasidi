@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.transfer_operations'))

@section('page-style')
<x-admin::table_grid.styles />
@endsection


@section('content')

<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-transfer-operations table">
                        <thead>
                            <tr>
                                <th></th>
                                <th> {{ __('global.client') }}</th>
                                <th> {{ __('global.mobile') }}</th>
                                <th> {{ __('global.amount') }}</th>
                                <th> {{ __('global.sim_type') }}</th>
                                <th> {{ __('global.status') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>


</section>

@endsection

@section('page-script')
<x-admin::table_grid.scripts />
<x-admin::scripts :files="[
        'vendors/js/extensions/dragula.min.js',
        'js/custom/settings/transfer_operations/index.js',
    ]" />
@endsection

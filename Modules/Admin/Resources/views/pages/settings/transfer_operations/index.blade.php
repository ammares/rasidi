@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.transfer_operations'))

@section('page-style')
<x-admin::table_grid.styles />
@endsection

@section('actions')
<x-admin::header_actions>
    <a type="button" class="btn btn-primary" href="{{ route('settings.keyfeatures.create') }}">
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
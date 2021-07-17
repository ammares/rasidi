@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.clients_bills'))

@section('page-style')
<x-admin::table_grid.styles />
@endsection

@section('actions')
<x-admin::header_actions>
    <a type="button" class="btn btn-primary" href="{{ route('settings') }}">
        <span class="align-middle">{{ __('global.import') }}</span>
    </a>
</x-admin::header_actions>
@endsection

@section('content')

<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-clients-bills table">
                        <thead>
                            <tr>
                                <th></th>
                                <th> {{ __('global.client') }}</th>
                                <th> National Num</th>
                                <th> Bill Type</th>
                                <th> Value</th>
                                <th> Is Paid?</th>
                                <th> Paid At</th>
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
        'js/custom/settings/clients_bills/index.js',
    ]" />
@endsection

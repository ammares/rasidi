@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.recharge_categories'))

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
                    <table class="datatables-categories table">
                        <thead>
                            <tr>
                                <th></th>
                                <th> {{ __('global.amount') }}</th>
                                <th> {{ __('global.price') }}</th>
                                <th> {{ __('global.created_at') }}</th>
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
        'js/custom/settings/categories/index.js',
    ]" />
@endsection
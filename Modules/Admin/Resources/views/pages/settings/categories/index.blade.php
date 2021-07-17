@extends('admin::layouts/contentLayoutMaster')

@section('title', __('global.recharge_categories'))

@section('page-style')
<x-admin::table_grid.styles />
@endsection

@section('actions')
<x-admin::header_actions>
    <a type="button" class="btn btn-primary" href="javascript:;" onclick="openCategoryForm()">
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

<div class="hide">
    <div class="category-form">
      <form method="POST" enctype="multipart/form-data" class="needs-validation">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" name="id" class="form-control">
                <div class="col-12">
                    <h6 for="name">{{ __('global.amount') }}</h6>
                    <div class="input-group">
                        <input type="number" name="amount" class="form-control" required>
                    </div>
                </div>
                <div class="col-12 mt-1">
                    <h6 for="email">{{__('global.price')}}</h6>
                    <div class="input-group">
                        <input type="number" name="price" class="form-control" required>
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
        'js/custom/settings/categories/index.js',
    ]" />
@endsection

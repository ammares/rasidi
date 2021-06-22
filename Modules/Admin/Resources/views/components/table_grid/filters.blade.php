<div id="filters" style="display: none;">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">@lang('global.table_grid.advanced_filters')</h3>
                </div>
                <div class="col-6">
                    <div class="btn-group float-right" role="group">
                        <a href="javascript:toggleFilters();" class="btn border-0 float-right">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="javascript:;" class="form-horizontal" id="filtersForm">
                {{ $slot }}
            </form>
            <div class="col-md-12 col-sm-12 pr-0 pl-0 filters-actions">
                <hr />
                <a href="javascript:prepFilters();"
                    class="btn btn-primary float-right">@lang('global.table_grid.submit')</a>
                <input type="reset" value="@lang('global.table_grid.reset')"
                    class="btn btn-outline-secondary float-right mr-1">
                <a href="javascript:toggleFilters();"
                    class="btn btn-link text-secondary float-right">@lang('global.table_grid.cancel')</a>
            </div>
        </div>
    </div>
</div>
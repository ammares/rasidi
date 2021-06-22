@props(['title', 'url', 'gridName', 'export' => true, 'lang' => false, 'filters' => true, 'order' => '[1, "asc"]',
'scrollY' => '', 'searchTooltip' => ''])

<section id="ajax-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom grid-heading d-flex align-items-center flex-wrap p-1">
                    <h3 class="card-title mr-auto">{{ $title }}</h3>
                    @if($lang)
                    <x-admin::grid_lang_dropdown grid-lang="{{$lang}}" datatable-reload="true" />
                    @endif
                    @if($export)
                    <div class="dropdown mr-1" id="grid-columns-list">
                        <button class="btn btn-icon btn-flat-primary waves-effect dropdown-toggle" type="button"
                            data-toggle="dropdown" aria-expanded="true">
                            <i data-feather='download-cloud'></i>
                        </button>
                        <ul class="dropdown-menu text-left" role="menu" aria-labelledby="excelDropdownMenu">
                            <a href="javascript:;" class="dropdown-item"
                                onclick="exportExcel('xlsx', false); return false;" target="_blank">
                                {{__('global.export_all_fields_xlsx')}}
                            </a>
                            <!-- <a href="javascript:;" class="dropdown-item"
                                onclick="exportExcel('xlsx', true); return false;" target="_blank">
                                {{__('global.export_current_fields_xlsx')}}
                            </a> -->
                            <div class="dropdown-divider"></div>
                            <a href="javascript:;" class="dropdown-item"
                                onclick="exportExcel('csv', false); return false;" target="_blank">
                                {{__('global.export_all_fields_csv')}}
                            </a>
                            <!-- <a href="javascript:;" class="dropdown-item"
                                onclick="exportExcel('csv', true); return false;" target="_blank">
                                {{__('global.export_current_fields_csv')}}
                            </a> -->
                        </ul>
                    </div>
                    @endif
                    <div class="dropdown mr-1" id="grid-columns-list">
                        <button class="btn btn-icon btn-flat-primary waves-effect dropdown-toggle" type="button"
                            data-toggle="dropdown" aria-expanded="true">
                            <i data-feather='columns'></i>
                        </button>
                        <ul class="dropdown-menu hide-show-columns text-left" role="menu"></ul>
                    </div>
                    @if($filters)
                    <a href="javascript:;" onclick="toggleFilters()"
                        class="btn btn-icon btn-flat-primary waves-effect mr-1 advanced-filters">
                        <i class="ficon fa-lg" data-feather="filter"></i>
                        {{-- @todo make a small badge; hide/show based on filters --}}
                        <span class="hide badge badge-pill badge-sm badge-danger badge-up"></span>
                    </a>
                    @endif
                    <a href="javascript:;" onclick="reloadDataGrid(false)"
                        class="btn btn-icon btn-flat-primary waves-effect">
                        <i data-feather='refresh-ccw'></i>
                    </a>
                </div>
                <div class="card-datatable">
                    <div id="dt_processing" class="dataTables_processing"><i
                            class="fa fa-spinner fa-spin fa-pulse fa-fw"></i></div>
                    <table class="datatables-ajax table dt-responsive text-nowrap table-grid table-hover"
                        data-url="{{ $url }}" data-grid-name="{{ $gridName }}" data-order='{{ $order }}'
                        data-scroll-y="{{ $scrollY or '' }}" data-search-placeholder="{{__('min 3 letters')}}"
                        data-search-tooltip="{{ $searchTooltip }}" width="100%">
                        <thead></thead>
                        <tfoot></tfoot>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="javascript:;" onclick="resetDataGridOptions()" class="btn btn-outline-gray float-right"
                        data-toggle="tooltip" data-placement="top" title="{{__('global.reset_search')}}">
                        <i class="fa fa-eraser"></i>&nbsp;&nbsp;<span>{{__('global.reset')}}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
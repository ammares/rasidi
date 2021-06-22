/* global HandleJsonErrors, ـaoColumns*/

var $dtProcessing = jQuery('#dt_processing');
var $gridColumnsList = jQuery('#grid-columns-list');
var $dropdownToggle = jQuery('body .dropdown-toggle');
var $hideShowColumnsList = jQuery('.hide-show-columns');
//Table Grid
var tableGrid;
var $tableGridObj = jQuery('.table-grid');
var tableGridData = $tableGridObj.data();
var tableGridDataSet;
//Filters
var $filtersContainer = jQuery('#filters');
var filters = [];
var $filtersForm = jQuery('#filtersForm');
jQuery(window).on('load', function () {
    // Bootstrap Dropdown Issue With DataTable
    $dropdownToggle.dropdown();
});
jQuery(function () {
    // Initialise DataTable
    tableGrid = $tableGridObj.DataTable({
        columns: window._aoColumns,
        stateSave: true,
        scrollX: true,
        processing: false,
        serverSide: true,
        ordering: true,
        regex: false,
        orderMulti: true,
        displayStart: 0,
        paging: true,
        pagingType: "simple_numbers",
        pageLength: 10,
        responsive: true,
        sAjaxDataProp: 'aaData',
        language: {
            emptyTable: '<div class="no-data-to-display"><i class="fa fa-exclamation-triangle"></i></br>' + Lang.get('global.no_data_to_display') + '</div>',
            zeroRecords: '<div class="no-data-to-display"><i class="fa fa-exclamation-triangle"></i></br>' + Lang.get('global.no_matching_records_found') + '</div>',
            sLengthMenu: 'Show _MENU_ entries',
            sInfo: 'Showing _START_ to _END_ of _TOTAL_ entries',
            sInfoEmpty: 'Showing 0 to 0 of 0 entries',
            sInfoFiltered: '(filtered from _MAX_ total entries)',
            sLoadingRecords: 'Loading...',
            sSearch: 'Search: ',
            oPaginate: {
                sFirst: 'First',
                sPrevious: 'Previous',
                sNext: 'Next',
                sLast: 'Last'
            }
        },
        stateLoadParams: function (settings, data) {
            if (!jQuery.isEmptyObject(data.columns)) {
                for (var col in data.columns) {
                    data.columns[col]['visible'] = data.columns[col]['visible'] === 'true';
                    window._aoColumns[col].sType !== 'html' ?
                        $hideShowColumnsList.append('<a class="dropdown-item" href="javascript:;" data-column="' + col + '"><i class="' + (data.columns[col]['visible'] ? 'far fa-check-square' : 'far fa-square') + '"></i> ' + window._aoColumns[col].sTitle + '</a>') :
                        false;
                }
            }
            if (!jQuery.isEmptyObject(data.filters)) {
                for (var i in data.filters.filter.value) {
                    if (data.filters.filter.value[i] !== '' && data.filters.filter.value[i] !== null) {
                        // console.log(jQuery('[name="filter.value"]:eq(' + i + ')').attr('class'));
                        // console.log(jQuery('[name="filter.value"]:eq(' + i + ')').length);
                        // console.log(data.filters.filter.value[i]);
                        if (jQuery('[name="filter.value"]:eq(' + i + ')').hasClass('select2')) {
                            var newOption = new Option(data.filters.filter.value[i], data.filters.filter.value[i], true, true);
                            jQuery('[name="filter.value"]:eq(' + i + ')').append(newOption).trigger('change');
                        } else {
                            jQuery('[name="filter.value"]:eq(' + i + ')').val(data.filters.filter.value[i]).removeAttr('readonly');
                        }
                        jQuery('[name="filter.operator"]:eq(' + i + ')').val(data.filters.filter.operator[i]);
                    }
                }
            }
            jQuery('.flatpickr-range').each(function () {
                initFilterDatePicker(jQuery(this));
            });
            checkFiltersIfExists();
            return data;
        },
        stateSaveCallback: function (settings, data) {
            data['filters'] = $filtersForm.serializeObject();
            jQuery.ajax({
                url: getBaseURL() + "grid_preferences",
                data: {
                    'key_name': tableGridData.gridName,
                    'key_value': data,
                    'url': 'grid_preferences'
                },
                dataType: "JSON",
                type: "POST",
                complete: function (response) {
                    if (!response.status) {
                        toastr.error(Lang.get('global.grid_saving_problem'), ''), {
                            timeOut: 3500
                        };
                    }
                },
                error: HandleJsonErrors
            });
        },
        stateLoadCallback: function () {
            var o;
            jQuery.ajax({
                url: getBaseURL() + 'grid_preferences',
                dataType: "JSON",
                type: "GET",
                async: false,
                data: {
                    'grid': tableGridData.gridName
                },
                success: function (response) {
                    // cast the length & start values to number in order to fix pagination info.
                    response.data.length = Number(response.data.length);
                    response.data.start = Number(response.data.start);
                    o = response.data;
                },
                error: HandleJsonErrors
            });
            if (!jQuery.isEmptyObject(o)) {
                filters = o.filters;
            }
            return o;
        },
        ajax: {
            url: getBaseURL() + tableGridData.url,
            type: "GET",
            dataType: "JSON",
            dataSrc: 'aaData',
            data: function (d) {
                d.url = tableGridData.gridName;
                d.filters = filters;
            },
            beforeSend: function () {
                checkFiltersIfExists();
            },
            complete: function () {
                $dtProcessing.css('display', 'none');
                if (isTouchDevice() === true) {
                    jQuery("[data-toggle='tooltip']").tooltip('disable');
                }
            },
            error: HandleJsonErrors
        },
        // START VUEXY THEM CUSTOMIZATIONS
        dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        orderCellsTop: !0,
        responsive: {
            details: true
        },
        // END VUEXY THEM CUSTOMIZATIONS
        aoColumns: window._aoColumns,
        aoColumnDefs: window._aoColumnDefs,
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            return _fnRowCallback(nRow, aData, iDisplayIndex);
        },
        fnServerParams: function (aoData) {
            aoData['filters'] = filters;
            tableGridDataSet = aoData;
        },
        initComplete: function (settings, json) {
            if (isEmpty($hideShowColumnsList.html())) {
                for (var col in window._aoColumns) {
                    window._aoColumns[col]['visible'] = 'true';
                    window._aoColumns[col].sType !== 'html' ?
                        $hideShowColumnsList.append('<a class="dropdown-item" href="javascript:;" data-column="' + col + '"><i class="far fa-check-square"></i> ' + window._aoColumns[col].sTitle + '</a>') :
                        false;
                }
            }
            jQuery('a', '.content-language-selector').on('click', function () {
                var lang = jQuery(this).data('lang');
                if (lang !== null && lang !== '' && lang !== undefined) {
                    jQuery('.lang-text').text(lang);
                    jQuery.ajax({
                        method: 'GET',
                        url: getBaseURL() + 'lang/' + lang,
                        dataType: 'json',
                        contentType: 'application/json; charset=UTF-8',
                        success: function () {
                            reloadDataGrid(false);
                        }
                    });
                }
            });
        }
    });
    // Fix dropdown overflow property
    jQuery('.card-datatable').on('show.bs.dropdown', function () {
        jQuery('.dataTables_scrollBody').css("overflow", "inherit");
        jQuery('.card-datatable').css("overflow", "inherit");
    });
    jQuery('.card-datatable').on('hide.bs.dropdown', function () {
        jQuery('.dataTables_scrollBody').css("overflow", "auto");
    });
    // Grab the datatables input box and alter how it is bound to events ,Add Quick Search Tooltip
    jQuery('.dataTables_filter input')
        .attr('data-toggle', 'tooltip')
        .attr('data-placement', 'bottom')
        .attr('placeholder', tableGridData.searchPlaceholder)
        .attr('title', tableGridData.searchTooltip)
        .unbind() // Unbind previous default bindings
        .bind("input", function (e) { // Bind our desired behavior
            if (this.value.length >= 3) { // Search if the length is 3 or more characters
                tableGrid.search(this.value).draw();
            }
            if (this.value === "") { // Ensure we clear the search if they backspace far enough
                tableGrid.search("").draw();
            }
            return;
        });
    // Bootstrap Dropdown Issue With DataTable
    $dropdownToggle.dropdown();
    //Bootstrap Tooltip Data Toggle
    jQuery('[data-toggle="tooltip"]').tooltip();
    // Highlight Table TR
    jQuery('table.dataTable tbody').on('click', 'td:not(".dt-actions")', function () {
        var _parentTr = jQuery(this).parent();
        _parentTr.hasClass('highlighted') ? _parentTr.removeClass('highlighted') : _parentTr.addClass('highlighted');
    });
    // Init select2 for filters
    // jQuery('.grid-filter-autocomplete .select2').select2({
    //     minimumInputLength: jQuery(this).data('min-letters') ? jQuery(this).data('min-letters') : 2,
    //     delay: 250,
    //     ajax: {
    //         url: getBaseURL() + jQuery(this).data('url'),
    //         dataType: 'json',
    //         type: 'GET',
    //         processResults: function (data) {
    //             var results = $.map(data, function (obj) {
    //                 obj.id = obj.text;
    //                 return obj;
    //             });
    //             return {
    //                 results: results
    //             };
    //         },
    //         cache: false
    //     },
    //     allowClear: true,
    // });
    jQuery('.filter-text-operator').change(function () {
        disableTextInputs(jQuery(this));
    }).change();
});

disableTextInputs = function ($this) {
    if (($this.val() === 'empty') || ($this.val() === 'not_empty')) {
        $this.parent().siblings('div').children('input').prop('disabled', true);
    } else {
        $this.parent().siblings('div').children('input').prop('disabled', false);
    }
};
// Events/Listeners
$gridColumnsList.on('click', 'a', function (e) {
    e.stopPropagation();
    e.preventDefault();
    // Get the column API object
    var column = tableGrid.column(jQuery(this).data('column'));
    tableGrid.columns([jQuery(this).attr('data-column')]).visible(!column.visible()); // Toggle the visibility
    jQuery('i', this).attr('class', column.visible() ? 'far fa-check-square' : 'far fa-square'); // Toggle column visibility icon
    tableGrid.draw();
});
$filtersForm.keypress(function (e) {
    if (e.which === 13 && $filtersContainer.is(":visible") === true) {
        e.stopPropagation();
        e.preventDefault();
        prepFilters();
    }
});
jQuery('input[type="reset"]', $filtersContainer).on('click', function () {
    filters = [];
    $filtersForm[0].reset();
    $filtersContainer.is(":visible") === true ? toggleFilters() : true;
    $('.select2-hidden-accessible').val(null).trigger('change');
    reloadDataGrid(false);
});
jQuery(window).on('load', function () {
    jQuery('a', $hideShowColumnsList).on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var column = tableGrid.column(jQuery(this).data('column'));
        tableGrid.columns([jQuery(this).attr('data-column')])
            .visible(!column.visible(), false); // Toggle the visibility
        jQuery('i', this).attr('class', column.visible() ? 'far fa-check-square' : 'far fa-square'); // Toggle column visibility icon
        tableGrid.draw();
    });
});

//Functions
function toggleFilters() {
    $filtersContainer.slideToggle({ duration: '300' });
}

function prepFilters() {
    jQuery('input', $filtersForm).each(function () {
        jQuery(this).attr('readonly') && jQuery(this).is(':not(.dt-date)') ? jQuery(this).val('') : null;
    });
    filters = $filtersForm.serializeObject();
    reloadDataGrid(false);
    toggleFilters();
}

function checkFiltersIfExists() {
    _existingFilters = false;
    jQuery('[name="filter.value"]', $filtersForm).each(function () {
        _existingFilters = !jQuery.isEmptyObject(this.value);
        if (_existingFilters)
            return false;
    });
    _existingFilters ? jQuery('.advanced-filters').addClass('existing-filters') : jQuery('.advanced-filters').removeClass('existing-filters');
}

function reloadDataGrid(pagination = true) {
    if (pagination) {
        tableGrid.ajax.reload(null, false);
    } else {
        tableGrid.ajax.reload();
    }
    jQuery('html, body').animate({
        scrollTop: jQuery(".grid-heading").offset().top - 10
    }, 1000);
}

function resetDataGridOptions() {
    filters = [];
    $filtersForm[0] ? $filtersForm[0].reset() : null;
    $filtersContainer.is(":visible") === true ? toggleFilters() : true;
    tableGrid.columns().visible(true);
    jQuery('i', jQuery('a', $gridColumnsList)).attr('class', 'fa fa-check-square-o');
    var oSettings = $tableGridObj.dataTable().fnSettings();
    oSettings.aaSorting = tableGridData.order;
    oSettings.oPreviousSearch['sSearch'] = '';
    oSettings._iDisplayLength = 10;
    tableGrid.search("");
    jQuery('select', 'div.dataTables_length').val('10');
    reloadDataGrid(false);
}

function initFilterDatePicker(rangePickr) {
    let startDate = jQuery(".start-date", rangePickr.parent()).val() ? jQuery(".start-date", rangePickr.parent()).val() : '';
    let endDate = jQuery(".end-date", rangePickr.parent()).val() ? jQuery(".end-date", rangePickr.parent()).val() : '';
    rangePickr.flatpickr({
        mode: "range",
        defaultDate: [startDate, endDate],
        onClose: function (date, e, t) {
            var startDate = new Date,
                endDate = new Date;
            null != date[0] && (startDate = date[0].getFullYear() + "-" + (date[0].getMonth() + 1) + "-" + date[0].getDate(),
                jQuery(".start-date", rangePickr.parent()).val(startDate));
            null != date[1] && (endDate = date[1].getFullYear() + "-" + (date[1].getMonth() + 1) + "-" + date[1].getDate(),
                jQuery(".end-date", rangePickr.parent()).val(endDate));
        }
    });
}

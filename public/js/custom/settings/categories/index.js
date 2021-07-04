$(function () {
    'use strict';

    var _categories = [];

    var dt_table_categories = $('.datatables-categories');

    if (dt_table_categories.length) {
        var dt_emailtemplates = dt_table_categories.DataTable({
            ajax: {
                url: getBaseURL() + 'settings/categories',
                type: "GET",
                dataType: "JSON",
                dataSrc: 'data',
                error: HandleJsonErrors
            },
            columns: [
                { data: 'id' },
                { data: 'amount' },
                {
                  data: 'price',
                  render: function (data, type, row, meta) {
                      return row['price']+' SYP';
                  }
                 },
                {
                    data: 'created_at',
                    render: function (data, type, row, meta) {
                        return date('d-m-Y g:i A', strtotime(row['created_at']));
                    }
                },
            ],
            columnDefs: [
                {
                    className: 'dt-actions',
                    orderable: false,
                    targets: 0,
                    render: function (data, type, row, meta) {
                        return (
                            `<div class="btn btn-icon btn-flat-primary">
                                <a class="dropdown-toggle hide-arrow text-primary" data-toggle="dropdown">
                                    <i class="fa fa-bars"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <a href="${getBaseURL()}settings/email_templates/${row['id']}/edit" class="dropdown-item">
                                        ${Lang.get('global.edit')}
                                    </a>
                                    <a class="dropdown-item" href="javascript:;"
                                        onclick="sendTestEmail(${row['id']},'client')">
                                        ${Lang.get('global.sent_test_email')}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:;" data-id="${row['id']}"
                                        data-name="${row['name']}"
                                        data-active="${row['active']}" onclick="activateDeactivate(this,'client')">
                                         ${(row['active'] == 0
                                ? Lang.get('global.activate')
                                : Lang.get('global.deactivate'))}
                                    </a>
                                </div>
                            </div>
                            <a href="javascript:;" class="btn btn-icon btn-flat-${row['active'] === '1' ? 'success' : 'danger'} waves-effect" data-id="${row['id']}"
                            data-name="${row['name']}" data-active="${row['active']}"
                            onclick="activateDeactivate(this,'client')">
                                <i data-toggle="tooltip" data-placement="top" title="${(row['active'] == 0 ? Lang.get('global.activate') : Lang.get('global.deactivate'))}"
                                class="fa fa-check d-inline"></i>
                            </a>`
                        );
                    }
                },
            ],
            fnRowCallback: function (nRow, aData, iDisplayIndex) {
                _categories[aData['id']] = aData;
                return nRow;
            },
            dom: '<"card-header border-bottom p-1"<"head-label-client"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 10,
            lengthMenu: [10, 25, 50, 75, 100],
            buttons: [
                {
                    extend: 'collection',
                    className: 'btn btn-icon btn-flat-primary waves-effect dropdown-toggle',
                    text: feather.icons['download-cloud'].toSvg({ class: 'font-small-4 mr-50' }) + 'Export',
                    buttons: [
                        {
                            extend: 'excel',
                            text: feather.icons['file'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel .xlsx',
                            className: 'dropdown-item',
                            exportOptions: { columns: [1, 2, 3] }
                        },
                        {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel .csv',
                            className: 'dropdown-item',
                            exportOptions: { columns: [1, 2, 3] }
                        },
                    ],
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                        $(node).parent().removeClass('btn-group');
                        setTimeout(function () {
                            $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                        }, 50);
                    }
                },
            ],
            language: {
                paginate: {
                    previous: '&nbsp;',
                    next: '&nbsp;'
                },
                emptyTable: noDataTemplate(),
            },
        });
        var data = dt_emailtemplates
            .rows()
            .data();
    }



})

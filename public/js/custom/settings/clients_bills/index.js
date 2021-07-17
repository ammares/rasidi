$(function () {
    'use strict';

    var clients_bills = [];

    var dt_tableclients_bills = $('.datatables-clients-bills');

    if (dt_tableclients_bills.length) {
        var dt_emailtemplates = dt_tableclients_bills.DataTable({
            ajax: {
                url: getBaseURL() + 'settings/clients_bills',
                type: "GET",
                dataType: "JSON",
                dataSrc: 'data',
                error: HandleJsonErrors
            },
            columns: [
                { data: 'id' },
                {
                    data: 'client_first_name',
                    render: function (data, type, row, meta) {
                        return row['client_first_name']+' '+row['client_last_name'] ;
                    }
                },
                { data: 'national_num' },
                { data: 'bill_type' },
                {
                  data: 'value',
                  render: function (data, type, row, meta) {
                      return row['value']+' SYP';
                  }
                 },
                 {
                   data: 'paid',
                   render: function (data, type, row, meta) {
                       return (row['paid']==0 ? 'Not Paid Yet' : 'Is Paid');
                   }
                  },
                {
                    data: 'payment_at',
                    render: function (data, type, row, meta) {
                        return (row['payment_at']?date('d-m-Y g:i A', strtotime(row['payment_at'])):'-');
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
                            `
                            <a href="javascript:;" class="btn btn-icon btn-flat-${row['paid'] == '1' ? 'success' : ''} waves-effect" waves-effect" data-id="${row['id']}"
                            data-name="${row['name']}" data-active="${row['status']}"
                            onclick="">
                                <i data-toggle="tooltip" data-placement="top" title="${(row['paid'] == 0 ? 'Not Paid' : 'Is Paid')}"
                                class="fa fa-check d-inline"></i>
                            </a>`
                        );
                    }
                },
            ],
            fnRowCallback: function (nRow, aData, iDisplayIndex) {
                clients_bills[aData['id']] = aData;
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
                            exportOptions: { columns: [1, 2, 3, 4, 5, 6] }
                        },
                        {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel .csv',
                            className: 'dropdown-item',
                            exportOptions: { columns: [1, 2, 3, 4, 5, 6] }
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

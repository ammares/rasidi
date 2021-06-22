$(function () {
    'use strict';

    var _emailtemplates_client = [],
        _emailtemplates_staff = [];

    var dt_table_client = $('.datatables-client'),
        dt_table_staff = $('.datatables-staff');

    if (dt_table_client.length) {
        var dt_emailtemplates = dt_table_client.DataTable({
            ajax: {
                url: getBaseURL() + 'settings/email_templates',
                type: "GET",
                dataType: "JSON",
                dataSrc: 'data.client',
                error: HandleJsonErrors
            },
            columns: [
                { data: 'id' },
                {
                    data: 'active',
                    visible: false,
                    render: function (data, type, row, meta) {
                        return (row['active'] == 1 ? Lang.get('global.activated') : Lang.get('global.deactivated'));
                    }
                },
                {
                    data: 'success_mail_logs_count',
                    visible: false,
                    render: function (data, type, row, meta) {
                        return row['error_mail_logs_count'] + 'error ' + row['success_mail_logs_count'] + 'success';
                    }
                },
                {
                    data: 'error_mail_logs_count',
                    render: function (data, type, row, meta) {
                        return `
                        <a class="error-onclick" href="javascript:;"
                            onclick="showFailedMailLogs(${row['id']},'${row['name']}',${row['error_mail_logs_count']},'client' )">
                            <span data-toggle="tooltip" data-placement="top" title="${row['error_mail_logs_count']} ${Lang.get('global.failed_mail_logs')}"
                                class="badge badge-light-danger">${row['error_mail_logs_count']}</span>
                        </a>
                        <a href="javascript:;"
                            onclick="showSuccessMailLogs(${row['id']},'${row['name']}',${row['success_mail_logs_count']}, 'client' )">
                            <span data-toggle="tooltip" data-placement="top" title="${row['success_mail_logs_count']} ${Lang.get('global.success_mail_logs')}"
                                class="badge badge-light-success">${row['success_mail_logs_count']}</span>
                        </a>
                        `;
                    }
                },
                {
                    data: 'name',
                    render: function (data, type, row, meta) {
                        return `${row['name']} <br> ${row['languages']}
                        `;
                    }
                },
                { data: 'rule' },
                {
                    data: 'updated_at',
                    render: function (data, type, row, meta) {
                        return date('d-m-Y g:i A', strtotime(row['updated_at']));
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
            order: [[1, 'desc']],
            fnRowCallback: function (nRow, aData, iDisplayIndex) {
                _emailtemplates_client[aData['id']] = aData;
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
                            exportOptions: { columns: [4, 5, 1, 2, 6] }
                        },
                        {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel .csv',
                            className: 'dropdown-item',
                            exportOptions: { columns: [4, 5, 1, 2, 6] }
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
        $('div.head-label-client').html(`<h6 class="mb-0">${Lang.get('global.to_client')}</h6>`);
        var data = dt_emailtemplates
            .rows()
            .data();
    }

    if (dt_table_staff.length) {
        var dt_emailtemplates = dt_table_staff.DataTable({
            ajax: {
                dataSrc: 'data.staff',
                error: HandleJsonErrors
            },
            columns: [
                { data: 'id' },
                {
                    data: 'active',
                    visible: false,
                    render: function (data, type, row, meta) {
                        return (row['active'] == 1 ? Lang.get('global.activated') : Lang.get('global.deactivated'));
                    }
                },
                {
                    data: 'success_mail_logs_count',
                    visible: false,
                    render: function (data, type, row, meta) {
                        return row['error_mail_logs_count'] + 'error ' + row['success_mail_logs_count'] + 'success';
                    }
                },
                {
                    data: 'error_mail_logs_count',
                    render: function (data, type, row, meta) {
                        return `
                        <a class="error-onclick" href="javascript:;"
                            onclick="showFailedMailLogs(${row['id']},'${row['name']}',${row['error_mail_logs_count']},'staff' )">
                            <span data-toggle="tooltip" data-placement="top" title="${row['error_mail_logs_count']} ${Lang.get('global.failed_mail_logs')}"
                                class="badge badge-light-danger">${row['error_mail_logs_count']}</span>
                        </a>
                        <a href="javascript:;"
                            onclick="showSuccessMailLogs(${row['id']},'${row['name']}',${row['success_mail_logs_count']}, 'staff' )">
                            <span data-toggle="tooltip" data-placement="top" title="${row['success_mail_logs_count']} ${Lang.get('global.success_mail_logs')}"
                                class="badge badge-light-success">${row['success_mail_logs_count']}</span>
                        </a>
                        `;
                    }
                },
                {
                    data: 'name',
                    render: function (data, type, row, meta) {
                        return `${row['name']} <br> ${row['languages']}
                        `;
                    }
                },
                { data: 'rule' },
                {
                    data: 'updated_at',
                    render: function (data, type, row, meta) {
                        return date('d-m-Y g:i A', strtotime(row['updated_at']));
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
                                        onclick="sendTestEmail(${row['id']},'staff')">
                                        ${Lang.get('global.sent_test_email')}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:;" data-id="${row['id']}"
                                        data-name="${row['name']}"
                                        data-active="${row['active']}" onclick="activateDeactivate(this,'staff')">
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
            order: [[1, 'desc']],
            fnRowCallback: function (nRow, aData, iDisplayIndex) {
                _emailtemplates_staff[aData['id']] = aData;
                return nRow;
            },
            dom: '<"card-header border-bottom p-1"<"head-label-staff"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
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
                            exportOptions: { columns: [4, 5, 1, 2, 6] },
                        },
                        {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel .csv',
                            className: 'dropdown-item',
                            exportOptions: { columns: [4, 5, 1, 2, 6] }
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
        $('div.head-label-staff').html(`<h6 class="mb-0">${Lang.get('global.to_staff')}</h6>`);
        var data = dt_emailtemplates
            .rows()
            .data();
    }

})


function showFailedMailLogs(id, templateName, sentCount, category) {
    $dialog = bootbox.dialog({
        title: Lang.get('global.failed_mail_logs'),
        message: jQuery('.error-mail-logs').html(),
        size: 'xl',
        onEscape: true,
        backdrop: true,
        swapButtonOrder: true,
        centerVertical: true,
        buttons: {
            cancel: {
                label: Lang.get('global.cancel'),
                className: 'btn-link text-secondary',
                callback: function () {
                    $dialog.modal('hide');
                }
            },
        }
    });
    $dialog.on('shown.bs.modal', function (e) {
        $dialogBody = $dialog.find('.bootbox-body');
        jQuery.ajax({
            url: `${getBaseURL()}settings/email_templates/${id}/mail_logs/${'error'}`,
            method: 'GET',
            beforeSend: function () {
                jQuery('.template-name', $dialogBody).html(templateName);
                jQuery('.sent-count', $dialogBody).html(sentCount);
            },
            success: function (response) {
                $clearLogs = jQuery('.clear-logs', $dialogBody)
                $clearLogs.removeClass('hide').removeClass('waves-effect')
                    .on('click', function () {
                        jQuery.ajax({
                            url: `${getBaseURL()}settings/email_templates/${id}/mail_logs/clear/error`,
                            method: 'POST',
                            beforeSend: function () {
                                btnLoading($clearLogs);
                            },
                            success: function () {
                                $('.datatables-' + category).DataTable().ajax.reload();
                            },
                            error: HandleJsonErrors,
                            complete: function () {
                                btnReset($clearLogs);
                                $dialog.modal('hide');
                            }
                        });
                    })
                $mail_logs = '';
                if (jQuery.isEmptyObject(response.mail_logs)) {
                    $mail_logs = `<tr><td colspan="3">${noDataTemplate()}</td></tr>`;
                }
                $.each(response.mail_logs, function (key, value) {
                    $meta = JSON.parse(value.meta);
                    $mail_logs += `<tr>
                        <td class="text-nowrap">${value.sent_at} </td> 
                        <td class="text-nowrap">${avatarWrapper(value)} </td>
                        <td>${$meta['error_message']} </td>
                    </tr>`;
                });
                jQuery('tbody', $dialogBody).html($mail_logs);
            },
            error: HandleJsonErrors
        });
    });
}

function showSuccessMailLogs(id, templateName, sentCount, category) {
    $dialog = bootbox.dialog({
        title: Lang.get('global.success_mail_logs'),
        message: jQuery('.success-mail-logs').html(),
        size: 'lg',
        onEscape: true,
        backdrop: true,
        swapButtonOrder: true,
        centerVertical: true,
        buttons: {
            cancel: {
                label: Lang.get('global.cancel'),
                className: 'btn-link text-secondary',
                callback: function () {
                    $dialog.modal('hide');
                }
            },
        }
    });
    $dialog.on('shown.bs.modal', function (e) {
        $dialogBody = $dialog.find('.bootbox-body');
        jQuery.ajax({
            url: `${getBaseURL()}settings/email_templates/${id}/mail_logs/${'success'}`,
            method: 'GET',
            beforeSend: function () {
                jQuery('.template-name', $dialogBody).html(templateName);
                jQuery('.sent-count', $dialogBody).html(sentCount);
            },
            success: function (response) {
                $clearLogs = jQuery('.clear-logs', $dialogBody)
                $clearLogs.removeClass('hide').removeClass('waves-effect')
                    .on('click', function () {
                        jQuery.ajax({
                            url: `${getBaseURL()}settings/email_templates/${id}/mail_logs/clear/success`,
                            method: 'POST',
                            beforeSend: function () {
                                btnLoading($clearLogs);
                            },
                            success: function () {
                                $('.datatables-' + category).DataTable().ajax.reload();
                            },
                            error: HandleJsonErrors,
                            complete: function () {
                                btnReset($clearLogs);
                                $dialog.modal('hide');
                            }
                        });
                    })
                $mail_logs = '';
                if (jQuery.isEmptyObject(response.mail_logs)) {
                    $mail_logs = `<tr><td colspan="2">${noDataTemplate()}</td></tr>`;
                }
                $.each(response.mail_logs, function (key, value) {
                    (value.full_name ?? (value.full_name = 'Test Mail'))
                    $mail_logs += `<tr>
                        <td class="text-nowrap">${value.sent_at} </td>
                        <td class="text-nowrap">${avatarWrapper(value)} </td>
                    </tr>`;
                });
                jQuery('tbody', $dialogBody).html($mail_logs);
            },
            error: HandleJsonErrors
        });
    });
}

function activateDeactivate($obj, category) {
    id = jQuery($obj).data('id')
    template_name = jQuery($obj).data('name')
    active = jQuery($obj).data('active')
    bootbox.confirm({
        message: `<h5> ${Lang.get('global.template')}: ${template_name}</h5>`,
        swapButtonOrder: true,
        centerVertical: true,
        onEscape: true,
        backdrop: true,
        buttons: {
            confirm: {
                label: active == 0 ? Lang.get('global.activate') : Lang.get('global.deactivate'),
                className: active == 0 ? 'btn-activate-deactivate btn-success' : 'btn-activate-deactivate btn-danger',
            },
            cancel: {
                label: Lang.get('global.cancel'),
                className: 'btn-link text-secondary'
            },
        },
        callback: function ($result) {
            if ($result) {
                jQuery.ajax({
                    url: `${getBaseURL()}settings/email_templates/${id}/activate_deactivate`,
                    method: 'PATCH',
                    beforeSend: function () {
                        btnLoading(jQuery('.btn-activate-deactivate'))
                    },
                    success: function (xhr) {
                        toastr.success(xhr.message);
                        $('.datatables-' + category).DataTable().ajax.reload();
                    },
                    complete: function () {
                        btnReset(jQuery('.btn-activate-deactivate'));
                    },
                    error: HandleJsonErrors,
                });
            }
        }
    });
}

function sendTestEmail(email_template, category) {
    $dialog = bootbox.dialog({
        title: Lang.get('global.sent_test_email'),
        message: jQuery('.send-test-email').html(),
        size: 'sm',
        onEscape: true,
        backdrop: true,
        swapButtonOrder: true,
        centerVertical: true,
        buttons: {
            send: {
                label: Lang.get('global.send'),
                className: 'btn btn-primary btn-send',
                callback: function () {
                    $dialogBody = $dialog.find('.bootbox-body');
                    $testEmail = jQuery('.test-email', $dialogBody);
                    if (validateEmail($testEmail.val())) {
                        jQuery.ajax({
                            url: `${getBaseURL()}settings/email_templates/${email_template}/send_test_mail`,
                            method: 'POST',
                            dataType: "JSON",
                            data: { 'email': $testEmail.val() },
                            beforeSend: function () {
                                btnLoading(jQuery('.btn-send', $dialog));
                            },
                            success: function (xhr) {
                                toastr.success(xhr.message);
                                $dialog.modal('hide');
                                $('.datatables-' + category).DataTable().ajax.reload();
                            },
                            error: HandleJsonErrors,
                            complete: function () {
                                btnReset(jQuery('.btn-send', $dialog));
                            }
                        });
                    }
                    return false;
                }
            },
            cancel: {
                label: Lang.get('global.cancel'),
                className: 'btn-link text-secondary',
                callback: function () {
                    $dialog.modal('hide');
                }
            },
        }
    });
}


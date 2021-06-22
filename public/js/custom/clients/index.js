// Export To Excel
exportExcel = function (format, currentFields) {
    if (currentFields) { //@todo, when export current fields need customize (for avatar column)
        window._aoColumns.forEach((columns, i) => {
            tableGridDataSet['columns'][i]['name'] = columns.sTitle;
            tableGridDataSet['columns'][i]['type'] = columns.sType;
        });
        tableGridDataSet['columns'][0]['name'] = Lang.get('global.client_id');
    }
    return window.open(`${getBaseURL()}clients/export?excel_format=${format}&current_fields=${currentFields}&${jQuery.param(tableGridDataSet)}`, '_blank');
};
var _clients = [];
var powerModulesColumns = [
    {
        name: ['device_title'],
        type: 'string',
    },
    {
        name: ['num_of_devices'],
        type: 'number',
    },
];
var _aoColumnDefs = [
    {
        className: "dt-actions",
        "orderable": false,
        "targets": [0]
    },
];
_fnRowCallback = function (nRow, aData, iDisplayIndex) {
    _clients[aData['id']] = aData;
    return nRow;
};
var _aoColumns = [
    {
        mData: 'id',
        sTitle: Lang.get('global.actions'),
        sType: 'html',
        bSearchable: false,
        bSortable: false,
        visible: true,
        render: function (data, type, row, meta) {
            return `<div class="btn btn-icon btn-flat-primary"">
                       <a class="dropdown-toggle hide-arrow text-primary"  data-toggle="dropdown">
                           <i class="fa fa-bars"></i>
                       </a>
                       <div class="dropdown-menu">
                            <a href="javascript:;" class="dropdown-item" data-id="${row['id']}" onclick="gatewayDetails(this)">
                                ${Lang.get('global.gateway_details')}
                            </a>
                            ${(row['gateway_id'] > 0
                    ? `
                            <a class="dropdown-item" href="javascript:;" onclick="powerMetrics()">
                               ${Lang.get('global.power_metrics')}
                            </a>
                            <a href="javascript:;" class="dropdown-item" data-id="${row['id']}" onclick="renewSubscription(this)">
                               ${Lang.get('global.renew_subscription')}
                            </a>`
                    : ``)}
                            <div class="dropdown-divider"></div>
                            <a href="javascript:;" class="dropdown-item" data-id="${row['id']}" onclick="saveClient(this)">
                                ${Lang.get('global.edit')}
                            </a>
                            <a href="javascript:;" class="dropdown-item" data-id="${row['id']}" onclick="resetPassword(this)">
                                ${Lang.get('global.reset_password')}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:;" class="dropdown-item" data-id="${row['id']}" onclick="banUnban(this)">
                                ${(row['ban'] == 1) ? Lang.get('global.unban') : Lang.get('global.ban')}
                            </a>
                       </div>
                    </div>
                    ${(row['ban'] > 0
                    ? `<i data-toggle="tooltip" data-placement="top" title="${Lang.get("global.ban")}"  class="fa fa-ban  text-danger d-inline"></i>`
                    : ``)}`;
        }
    },
    {
        mData: 'first_name',
        sTitle: Lang.get('global.client'),
        sType: 'string',
        bSearchable: false,
        render: function (data, type, full, meta) {
            var $name = full['first_name'] + ' ' + full['middle_name'] + ' '+ full['last_name'],
                $email = full['email'],
                $image = full['avatar'],
                stateNum = Math.floor(Math.random() * 6),
                states = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'],
                $state = states[stateNum],
                $initials = $name.match(/\b\w/g) || [];
            $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
            if ($image) {
                // For Avatar image
                var $output =
                    '<img  src="' + assetPath + 'images/avatars/' + $image + '" alt="Avatar" width="32" height="32">';
            } else {
                // For Avatar badge
                $output = '<div class="avatar-content">' + $initials + '</div>';
            }
            // Creates full output for row
            var colorClass = $image === '' ? ' bg-light-' + $state + ' ' : ' ';

            var $rowOutput =
                '<div class="d-flex justify-content-left align-items-center">' +
                '<div class="avatar-wrapper">' +
                '<div class="avatar' +
                colorClass +
                'mr-50">' +
                $output +
                '</div>' +
                '</div>' +
                '<div class="d-flex flex-column">' +
                '<h6 class="user-name text-truncate mb-0">' +
                $name +
                '</h6>' +
                '<small class="text-truncate text-muted">' +
                $email +
                '</small>' +
                '</div>' +
                '</div>';
            return $rowOutput;
        }
    },
    {
        mData: 'national_num',
        sTitle: 'National Num',
        sType: 'string',
        bSearchable: false,
    },
    {
        mData: 'mobile',
        sTitle: 'Mobile',
        sType: 'string',
        bSearchable: false,
    },
    {
        mData: 'phone',
        sTitle: 'Phone',
        sType: 'string',
        bSearchable: false,
    },
    {
        mData: 'address',
        sTitle: 'Address',
        sType: 'string',
        bSearchable: false,
        render: function (data, type, row, meta) {
            return row['phone'] ? row['phone'] : '-';
        }
    },
    {
        mData: 'balance',
        sTitle: 'Balance',
        sType: 'string',
        bSearchable: false,
    },
];

function gatewayDetails($this) {
    id = jQuery($this).data('id');
    var client = _clients[id];
    $dialog = bootbox.dialog({
        title: Lang.get('global.gateway_details'),
        message: jQuery('.gateways-details').html(),
        size: 'lg',
        onEscape: true,
        backdrop: true,
        swapButtonOrder: true,
        centerVertical: true,
        buttons: {
            close: {
                label: Lang.get('global.close'),
                className: 'btn-link text-secondary',
                callback: function () {
                    $dialog.modal('hide');
                }
            },
        },
    });
    $dialog.init(function () {
        $dialogBody = $dialog.find('.bootbox-body');
        $dialogBody.append('<div class="overlay"><i class="fa fa-spinner fa-2x fa-spin"></i></div>');
        jQuery.ajax({
            type: "GET",
            url: `${getBaseURL()}clients/${id}/gateway_details`,
            complete: (xhr) => {
                if (xhr.status === 200) {
                    var client = xhr.responseJSON.data;
                    jQuery('.client-name', $dialogBody).html(client.first_name + ' ' + client.last_name);
                    jQuery('.client-email', $dialogBody).html(client.email);

                    if (!jQuery.isEmptyObject(client.gateway) && 'gateway' in client.gateway) {
                        jQuery('.serial-number', $dialogBody).html(client.gateway.gateway.serial_number);
                        jQuery('.connected', $dialogBody).html(Lang.get('connected'));
                    } else {
                        jQuery('.serial-number', $dialogBody).html('-');
                        jQuery('.connected', $dialogBody).html(Lang.get('global.not_connected'));
                    }

                    if (!jQuery.isEmptyObject(client.gateway) && 'subscription_date' in client.gateway) {
                        jQuery('.subscription-date', $dialogBody).html(date('d-m-Y', strtotime(client.gateway.subscription_date)));
                        jQuery('.subscribed', $dialogBody).html(Lang.get('subscribed'));
                    } else {
                        jQuery('.subscription-date', $dialogBody).html('-');
                        jQuery('.subscribed', $dialogBody).html(Lang.get('global.not_subscribed'));
                    }

                    jQuery('.solar-pv', $dialogBody).html((client.solar_pv + 0) + ' kw');
                    jQuery('.battery-storage', $dialogBody).html((client.battery_storage + 0) + ' kwh');

                    var devices_rows = '';
                    for (var key in client.devices) {
                        devices_rows += `
                            <tr>
                                <td>${client.devices[key].device['title']}</td>
                                <td>${client.devices[key]['identifier'] ? client.devices[key]['identifier'] : '-'}</td>
                                <td>${client.devices[key]['label']}</td>
                                <td>
                                    <div class="custom-control custom-control-success custom-switch">
                                        <input onclick="" id="${key}" checked="${client.devices[key]['connected'] === '1' ? 'checked' : ''}" type="checkbox" class="custom-control-input">
                                        <label class="custom-control-label" for="${key}"></label>
                                    </div>
                                </td>
                            </tr>
                        `;
                        devices_rows != '' ? jQuery('.power-modules tbody', $dialogBody).html(devices_rows) : false;
                    }
                }
                jQuery('.overlay', $dialogBody).remove();
            },
            error: HandleJsonErrors
        });
    });
}

function powerMetrics() {
    toastr.success('to be implemented in phase 2');
}

function saveClient($this) {
    id = jQuery($this).data('id');
    $dialog = bootbox.dialog({
        title: Lang.get('global.edit_client'),
        message: jQuery('.client-form').html(),
        size: 'lg',
        onEscape: true,
        backdrop: true,
        swapButtonOrder: true,
        centerVertical: true,
        buttons: {
            save: {
                label: Lang.get('global.save'),
                className: 'btn-primary btn-save-client',
                callback: function () {
                    $dialogBody = $dialog.find('.bootbox-body');
                    let $formData = new FormData(jQuery('form', $dialogBody)[0]);
                    jQuery.ajax({
                        url: `${getBaseURL()}clients/update/${id}`,
                        method: 'POST',
                        data: $formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function () {
                            btnLoading(jQuery('.btn-save-client', $dialog));
                        },
                        success: function (xhr) {
                            toastr.success(xhr.message);
                            reloadDataGrid();
                            $dialog.modal('hide');
                        },
                        error: HandleJsonErrors,
                        complete: function () {
                            btnReset(jQuery('.btn-save-client', $dialog));
                        }
                    });
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
    $dialog.init(function () {
        $dialogBody = $dialog.find('.bootbox-body');
        let $client = _clients[id];
        jQuery('input[name="first_name"]', $dialogBody).val($client['first_name']);
        jQuery('input[name="last_name"]', $dialogBody).val($client['last_name']);
        jQuery('input[name="email"]', $dialogBody).val($client['email']);
        jQuery('input[name="mobile"]', $dialogBody).val($client['mobile']);
        $client['latitude'] ? jQuery('.client-lat-long', $dialogBody).html($client['latitude'] + ', ' + $client['longitude']) : false;
        jQuery('.client-location', $dialogBody).html([$client['country'], $client['city']].join('-'));
    });
}

function renewSubscription($this) {
    id = jQuery($this).data('id');
    $dialog = bootbox.dialog({
        title: Lang.get('global.renew_subscription'),
        message: jQuery('.client-renew-subscription').html(),
        size: 'md',
        onEscape: true,
        backdrop: true,
        swapButtonOrder: true,
        centerVertical: true,
        buttons: {
            save: {
                label: Lang.get('global.renew'),
                className: 'btn-primary btn-renew',
                callback: function () {
                    $dialogBody = $dialog.find('.bootbox-body');
                    let $formData = new FormData(jQuery('form', $dialogBody)[0]);
                    jQuery.ajax({
                        url: `${getBaseURL()}clients/${id}/renew_subscription`,
                        method: 'POST',
                        data: $formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function () {
                            btnLoading(jQuery('.btn-renew', $dialog));
                        },
                        success: function (xhr) {
                            toastr.success(xhr.message);
                            reloadDataGrid();
                            $dialog.modal('hide');
                        },
                        error: HandleJsonErrors,
                        complete: function () {
                            btnReset(jQuery('.btn-renew', $dialog));
                        }
                    });
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
    $dialog.init(function () {
        $dialogBody = $dialog.find('.bootbox-body');
        jQuery('.current-subscription-date', $dialogBody).html(
            date('Y-m-d g:i A', strtotime(_clients[id]['subscription_date']))
        );
        jQuery('.subscription-date', $dialogBody).flatpickr({
            minDate: "today"
        });
    });
}

function activateDeactivate($this) {
    let id = jQuery($this).data('id');
    var client = _clients[id];
    var actionName = client['active'] === '1' ? Lang.get('global.deactivate') : Lang.get('global.activate');
    $dialog = bootbox.confirm({
        title: Lang.get('global.confirm'),
        message: `<h5> ${Lang.get('global.do_you_really_want_to_action_name', { 'action': actionName.toLowerCase(), 'name': '<b>" ' + client['first_name'] + " " + client['last_name'] + ' "</b>' })}</h5>`,
        swapButtonOrder: true,
        centerVertical: true,
        onEscape: true,
        backdrop: true,
        buttons: {
            confirm: {
                label: actionName,
                className: client['active'] == 0 ? 'btn-activate-deactivate btn-success' : 'btn-activate-deactivate btn-danger',
            },
            cancel: {
                label: Lang.get('global.cancel'),
                className: 'btn-link text-secondary'
            },
        },
        callback: function ($result) {
            if ($result) {
                jQuery.ajax({
                    url: `${getBaseURL()}clients/${id}/activate_deactivate`,
                    method: 'PATCH',
                    beforeSend: function () {
                        btnLoading(jQuery('.btn-activate-deactivate', $dialog))
                    },
                    success: function (xhr) {
                        toastr.success(xhr.message);
                        reloadDataGrid();
                    },
                    error: HandleJsonErrors,
                    complete: function () {
                        btnReset(jQuery('.btn-activate-deactivate', $dialog));
                    }
                });
            }
        }
    });
}

function banUnban($this) {
    let id = jQuery($this).data('id');
    var client = _clients[id];
    var actionName = client['ban'] === '1' ? Lang.get('global.unban') : Lang.get('global.ban');
    $dialog = bootbox.confirm({
        title: Lang.get('global.confirm'),
        message: `<h5> ${Lang.get('global.do_you_really_want_to_action_name', { 'action': actionName.toLowerCase(), 'name': '<b>" ' + client['first_name'] + " " + client['last_name'] + ' "</b>' })}</h5>`,
        swapButtonOrder: true,
        centerVertical: true,
        onEscape: true,
        backdrop: true,
        buttons: {
            confirm: {
                label: actionName,
                className: client['ban'] == 0 ? 'btn-ban btn-danger' : 'btn-ban btn-success',
            },
            cancel: {
                label: Lang.get('global.cancel'),
                className: 'btn-link text-secondary'
            },
        },
        callback: function ($result) {
            if ($result) {
                jQuery.ajax({
                    url: `${getBaseURL()}clients/${id}/ban_unban`,
                    method: 'PATCH',
                    beforeSend: function () {
                        btnLoading(jQuery('.btn-ban', $dialog))
                    },
                    success: function (xhr) {
                        toastr.success(xhr.message);
                        reloadDataGrid();
                    },
                    error: HandleJsonErrors,
                    complete: function () {
                        btnReset(jQuery('.btn-ban', $dialog));
                    }
                });
            }
        }
    });
}

function resetPassword($this) {
    let id = jQuery($this).data('id');
    $dialog = bootbox.confirm({
        title: Lang.get('global.confirm'),
        message: `<h5> ${Lang.get('global.do_you_really_want_to_action_name', { 'action': Lang.get('global.reset').toLowerCase(), 'name': '<b>" ' + _clients[id]['first_name'] + " " + _clients[id]['last_name'] + ' "</b>' })}</h5>`,
        swapButtonOrder: true,
        centerVertical: true,
        onEscape: true,
        backdrop: true,
        buttons: {
            confirm: {
                label: Lang.get('global.reset'),
                className: 'btn-reset btn-warning',
            },
            cancel: {
                label: Lang.get('global.cancel'),
                className: 'btn-link text-secondary'
            },
        },
        callback: function ($result) {
            if ($result) {
                jQuery.ajax({
                    url: `${getBaseURL()}clients/${id}/reset_password`,
                    method: 'PATCH',
                    beforeSend: function () {
                        btnLoading(jQuery('.btn-reset', $dialog))
                    },
                    success: function (xhr) {
                        toastr.success(xhr.message);
                        reloadDataGrid();
                    },
                    error: HandleJsonErrors,
                    complete: function () {
                        btnReset(jQuery('.btn-reset', $dialog));
                    }
                });
            }
        }
    });
}

// Export To Excel
exportExcel = function (format, currentFields) {
    if (currentFields) {
        window._aoColumns.forEach((columns, i) => {
            tableGridDataSet['columns'][i]['name'] = columns.sTitle;
            tableGridDataSet['columns'][i]['type'] = columns.sType;
        });
        tableGridDataSet['columns'][0]['name'] = Lang.get('global.message_id');
    }
    return window.open(`${getBaseURL()}messages/export?excel_format=${format}&current_fields=${currentFields}&${jQuery.param(tableGridDataSet)}`, '_blank');
};

var _contact_us = [];
var _aoColumnDefs = [
    {
        className: "dt-actions",
        "orderable": false,
        "targets": [0]
    },
];
_fnRowCallback = function (nRow, aData, iDisplayIndex) {
    _contact_us[aData['id']] = aData;
    return nRow;
};
var _aoColumns = [
    {
        mData: 'id',
        sTitle: '',
        sType: 'html',
        bSearchable: false,
        bSortable: false,
        visible: true,
        render: function (data, type, row, meta) {
            return ` <div class="btn btn-icon btn-flat-primary">
                        <a class="dropdown-toggle hide-arrow text-primary" data-toggle="dropdown">
                        <i class="fa fa-bars"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="devices-actions">
                            <a class="dropdown-item" href="javascript:;" onclick="showMessage(${row['id']})">
                                 ${Lang.get('global.details')}
                            </a>
                            <div class="dropdown-divider"></div>
                            ${(row['replied_at'] != null
                    ? `  <a class="dropdown-item disabled" href="javascript:;">
                                 ${Lang.get('global.replied')}
                                </a>`
                    : ` <a class="dropdown-item" href="javascript:;" onclick="markAsReplied(${row['id']})">
                                 ${Lang.get('global.mark_replied')}
                                </a>`)}
                        </div>
                    </div>                     
                    ${(row['replied_at'] != null
                    ? `<i data-toggle="tooltip" data-placement="top" title="Replied ${date('d-m-Y g:i A', strtotime(row['replied_at']))}"  class="px-0 fas fa-reply text-success d-inline"></i>`
                    : `<a class="btn btn-sm px-0 d-inline" href="javascript:;" onclick="markAsReplied(${row['id']})">
                         <i data-toggle="tooltip" data-placement="top" title="${Lang.get('global.not_replied')}"  class="fas fa-reply"></i>
                       </a>`)
                }`;
        }
    },
    {
        mData: 'contacted_at',
        sTitle: Lang.get('global.contacted_at'),
        sType: 'date',
        bSearchable: false,
        render: function (data, type, row, meta) {
            return date('d-m-Y g:i A', strtotime(row['contacted_at']));
        }
    },
    {
        mData: 'client_name',
        sTitle: Lang.get('global.name'),
        sType: 'string',
        bSearchable: false,
    },
    {
        mData: 'subject',
        sTitle: Lang.get('global.subject'),
        sType: 'string',
        bSearchable: false,
    },
    {
        mData: 'message',
        sTitle: Lang.get('global.message'),
        sType: 'string',
        bSearchable: false,
        render: function (data, type, row, meta) {
            return row['message'].substring(0, 50).concat('...');
        }
    },
];

function showMessage(id) {
    $dialog = bootbox.dialog({
        title: Lang.get('global.message_details'),
        message: jQuery('.message-details').html(),
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
        let $message_details = _contact_us[id];
        $dialogBody.find('.client-name').html($message_details.client_name);
        $dialogBody.find('.contacted-at').html(date('d-m-Y g:i A', strtotime($message_details.contacted_at)));
        $dialogBody.find('.client-email').html($message_details.client_email);
        $dialogBody.find('.client-mobile').html($message_details.client_mobile);
        $dialogBody.find('.subject').html($message_details.subject);
        $dialogBody.find('.message').html($message_details.message);
        console.log($message_details.replied_at);
        if ($message_details.replied_at) {
            $dialogBody.find('.replied-icon').attr('class', 'fas fa-reply text-success');
            $dialogBody.find('.replied-at').html(date('d-m-Y g:i A', strtotime($message_details.replied_at)));
        } else {
            $dialogBody.find('.replied-icon').attr('class', 'fas fa-reply');
            $dialogBody.find('.replied-at').html(Lang.get('global.not_replied_yet'));
        }
    });
}

function markAsReplied(id) {
    bootbox.confirm({
        title: Lang.get('global.confirm'),
        message: Lang.get('global.mark_replied?'),
        size: 'sm',
        swapButtonOrder: true,
        centerVertical: true,
        onEscape: true,
        backdrop: true,
        buttons: {
            confirm: {
                label: Lang.get('global.confirm'),
                className: 'btn btn-primary btn-confirm-replied',
            },
            cancel: {
                label: Lang.get('global.cancel'),
                className: 'btn-link text-secondary'
            },
        },
        callback: function ($result) {
            if ($result) {
                jQuery.ajax({
                    url: `${getBaseURL()}messages/${id}/mark_as_replied`,
                    method: 'PATCH',
                    beforeSend: function () {
                        btnLoading(jQuery('.btn-confirm-replied'))
                    },
                    success: function (xhr) {
                        toastr.success(xhr.message);
                        reloadDataGrid();
                    },
                    complete: function () {
                        btnReset(jQuery('.btn-confirm-replied'));
                    },
                    error: HandleJsonErrors,
                });
            }
        }
    });
}




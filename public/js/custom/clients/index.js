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

// Export To Excel
exportExcel = function (format, currentFields) {
    if (currentFields) {
        window._aoColumns.forEach((columns, i) => {
            tableGridDataSet['columns'][i]['name'] = columns.sTitle;
            tableGridDataSet['columns'][i]['type'] = columns.sType;
        });
        tableGridDataSet['columns'][0]['name'] = Lang.get('global.login_logs_id');
    }
    return window.open(`${getBaseURL()}reports/login_logs/export?excel_format=${format}&current_fields=${currentFields}&${jQuery.param(tableGridDataSet)}`, '_blank');
};

var loginLogsId = '';
var gridLang = jQuery('#grid-lang').val();
var _loginLogs = [];
var _aoColumnDefs = [];
_fnRowCallback = function (nRow, aData, iDisplayIndex) {
    _loginLogs[aData['id']] = aData;
    return nRow;
};
var _aoColumns = [
    {
        mData: 'login_date',
        sTitle: Lang.get('global.login_date'),
        sType: 'datetime',
        bSearchable: false,
        bSortable: true,
        visible: true,
        render: function (data, type, row, meta) {
            return date('M j, Y g:i A', strtotime(row['login_date']));
        }
    },
    {
        mData: 'username',
        sTitle: Lang.get('global.username'),
        sType: 'string',
        bSearchable: true,
        bSortable: true,
        visible: true,
        render: function (data, type, full, meta) {
            var $name = full['username'],
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
        mData: 'role',
        sTitle: Lang.get('global.role'),
        sType: 'string',
        bSearchable: true,
        bSortable: true,
        visible: true,
        render: function (data, type, row, meta) {
            return row['role'] && row['role']['name'] ? row['role']['name'] : ``;
        }
    },
    {
        mData: 'ip_address',
        sTitle: Lang.get('global.ip_address'),
        sType: 'string',
        bSearchable: true,
        bSortable: true,
        visible: true,
    },
    {
        mData: 'status',
        sTitle: Lang.get('global.status'),
        sType: 'string',
        bSearchable: true,
        bSortable: true,
        visible: true,
        render: function (data, type, row, meta) {
            return row['status'] === 'Success' ? `<span class="text-success">${row['status']}</span>` : `<span class="text-danger">${row['status']}</span>`;
        }
    },
    {
        mData: 'note',
        sTitle: Lang.get('global.note'),
        sType: 'string',
        bSearchable: true,
        bSortable: false,
        visible: true,
    },
];
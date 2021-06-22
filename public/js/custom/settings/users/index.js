var _users = [];
var _aoColumnDefs = [
    {
        className: "dt-actions",
        "orderable": false,
        "targets": [0]
    },
];
_fnRowCallback = function (nRow, aData, iDisplayIndex) {
    _users[aData['id']] = aData;
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
            return `<div class="btn btn-icon btn-flat-primary">
                        <a class="dropdown-toggle hide-arrow text-primary" data-toggle="dropdown">
                            <i class="fa fa-bars"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:;" onclick="openUserForm(${row['id']})">
                                ${Lang.get('global.edit')}
                            </a>
                            <a class="dropdown-item" href="javascript:;" onclick="activateDeactivate(${row['id']})">
                                ${row['active'] === '1' ? Lang.get('global.deactivate') : Lang.get('global.activate')}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:;" onclick="resetPassword(${row['id']})">
                                ${Lang.get('global.reset_password')}
                            </a>
                       </div>
                    </div>
                    <a href="javascript:;" class="btn btn-icon btn-flat-${row['active'] === '1' ? 'success' : 'danger'} waves-effect" data-id="${row['id']}" onclick="activateDeactivate(${row['id']})">
                        <i class="fa fa-check d-inline"></i>
                    </a>`;
        }
    },
    {
        mData: 'name',
        sTitle: Lang.get('global.name'),
        sType: 'string',
        bSearchable: false,
    },
    {
        mData: 'roles',
        sTitle: Lang.get('global.role'),
        sType: 'string',
        bSearchable: false,
        render: function (data, type, row, meta) {
            var roles = [];
            for (const key in row['roles']) {
                roles.push((row['roles'][key]['name']).replace(/\w\S*/g, (w) => (w.replace(/^\w/, (c) => c.toUpperCase()))));
            }
            return roles.length ? roles.join(', ') : '-';
        }
    },
    {
        mData: 'email',
        sTitle: Lang.get('global.email'),
        sType: 'string',
        bSearchable: false,
    },
    {
        mData: 'mobile',
        sTitle: Lang.get('global.phone'),
        sType: 'string',
        bSearchable: false,
    },
    {
        mData: 'created_at',
        sTitle: Lang.get('global.created_at'),
        sType: 'string',
        bSearchable: false,
        render: function (data, type, row, meta) {
            return date('d-m-Y g:i A', strtotime(row['created_at']));
        }
    },
];

function openUserForm(id = null) {
    $dialog = bootbox.dialog({
        title: ((id) ? Lang.get('global.edit_user') : Lang.get('global.add_new_user')),
        message: jQuery('.user-form').html(),
        size: 'lg',
        onEscape: true,
        backdrop: true,
        swapButtonOrder: true,
        centerVertical: true,
        buttons: {
            submit: {
                label: Lang.get('global.save'),
                className: 'btn btn-primary btn-save',
                callback: function () {
                    $btnConfirm = jQuery('.btn-save', $dialog);
                    let formElement = jQuery('form', $dialog);
                    let $formData = new FormData(formElement[0]);
                    let $icon = jQuery('[name="avatar"]', $dialog)[0].files[0];

                    if ($icon) {
                        $formData.append('icon', jQuery('[name="avatar"]', $dialog)[0].files[0]);
                    }
                    if (id) {
                        jQuery.ajax({
                            url: `${getBaseURL()}settings/users/${userId}`,
                            method: 'POST', //@todo, when use patch it does not update, even the route is PATCH
                            data: $formData,
                            contentType: false,
                            processData: false,
                            beforeSend: function () {
                                btnLoading($btnConfirm);
                            },
                            success: function (xhr) {
                                toastr.success(xhr.message);
                                reloadDataGrid();
                                $dialog.modal('hide');
                            },
                            error: HandleJsonErrors,
                            complete: function () {
                                btnReset($btnConfirm);
                            }
                        });
                    } else {
                        jQuery.ajax({
                            url: `${getBaseURL()}settings/users`,
                            method: 'POST',
                            data: $formData,
                            contentType: false,
                            processData: false,
                            beforeSend: function () {
                                btnLoading($btnConfirm);
                            },
                            success: function (xhr) {
                                toastr.success(xhr.message);
                                reloadDataGrid();
                                $dialog.modal('hide');
                            },
                            error: HandleJsonErrors,
                            complete: function () {
                                btnReset($btnConfirm);
                            }
                        });
                    }
                    return false;
                }
            },
            cancel: {
                label: Lang.get('global.cancel'),
                className: 'btn btn-link text-secondary',
                callback: function () {
                    $dialog.modal('hide');
                }
            }
        },
    });
    $dialog.on('shown.bs.modal', function (e) {
        $dialogBody = $dialog.find('.bootbox-body');
        jQuery('[data-class]', $dialogBody).each(function (index, element) {
            $(this).addClass($(this).data('class'));
        });
        jQuery(prepearImagePreview);
        jQuery('.image-preview-clear', $dialogBody).css('display', 'none')
        jQuery('.image-preview-container', $dialogBody).remove()
        jQuery('.image-preview-filename', $dialogBody).attr('placeholder', Lang.get('global.upload_avatar'));
        if (id) {
            userId = id;
            let $user = _users[id];
            jQuery('form', $dialogBody).addClass('was-validated')
                .append(`<input name="_method" type="hidden" value="PATCH">`);
            jQuery('[name="name"]', $dialogBody).val($user.name);
            jQuery('[name="email"]', $dialogBody).val($user.email);
            jQuery('[name="mobile"]', $dialogBody).val($user.mobile);
            if( $user.roles.length){
                jQuery('[name="role"]', $dialogBody).find('.'+$user.roles[0].name).attr('selected', true);
                if($user.id == 1 && $user.roles[0].name=='admin'){
                    jQuery('[name="role"]', $dialogBody).prop("disabled", true);
                 }
            }
            jQuery('[name="role"]', $dialogBody).find('.role').html(Lang.get('global.no_role'));
            jQuery('.image-preview-filename', $dialogBody).attr('placeholder', '');
            jQuery('.image-preview-clear', $dialogBody).css('display', 'inline')
            jQuery('.icon-container', $dialogBody)
                .append(`
                    <div class="image-preview-container mt-1">
                        <img class="img-responsive img-rounded"
                                src="${($user.avatar && $user.avatar != 'user_silhouette.png') ? getWebsiteBaseURL() + 'storage/avatars/' + $user.avatar : getWebsiteBaseURL() + 'images/custom/user_silhouette.png'}"
                                alt="user icon">
                    </div>
                `);
            jQuery('[name="password"]', $dialogBody).prop("disabled", true);
        }
    });
}

function activateDeactivate(id) {
    var user = _users[id];
    var actionName = user['active'] === '1' ? Lang.get('global.deactivate') : Lang.get('global.activate');
    bootbox.confirm({
        title: Lang.get('global.confirm'),
        message: Lang.get('global.do_you_really_want_to_action_name', { 'action': actionName.toLowerCase(), 'name':'<b>" '+  user.email  +' "</b>'}),
        size: 'sm',
        onEscape: true,
        backdrop: true,
        swapButtonOrder: true,
        centerVertical: true,
        buttons: {
            confirm: {
                label: Lang.get('global.confirm'),
                className: 'btn btn-primary btn-activate-deactivate'
            },
            cancel: {
                label: Lang.get('global.cancel'),
                className: 'btn btn-link text-secondary'
            }
        },
        callback: function (result) {
            if (result) {
                $btnConfirm = jQuery('.btn-activate-deactivate');
                jQuery.ajax({
                    url: `${getBaseURL()}settings/users/${id}/activate_deactivate`,
                    method: 'PATCH',
                    beforeSend: function () {
                        btnLoading($btnConfirm);
                    },
                    success: function (xhr) {
                        reloadDataGrid();
                        toastr.success(xhr.message);
                    },
                    error: HandleJsonErrors,
                    complete: function () {
                        btnReset($btnConfirm);
                    }
                });
            }
        }
    })
}

function resetPassword(id) {
    var user = _users[id];
    var actionName = Lang.get('global.reset_password');
    bootbox.confirm({
        title: Lang.get('global.confirm'),
        message: Lang.get('global.do_you_really_want_to_action_name', { 'action': actionName.toLowerCase(), 'name': '<b>" '+  user.email  +' "</b>'  }),
        size: 'sm',
        onEscape: true,
        backdrop: true,
        swapButtonOrder: true,
        centerVertical: true,
        buttons: {
            confirm: {
                label: Lang.get('global.confirm'),
                className: 'btn btn-primary btn-reset-password'
            },
            cancel: {
                label: Lang.get('global.cancel'),
                className: 'btn btn-link text-secondary'
            }
        },
        callback: function (result) {
            if (result) {
                $btnConfirm = jQuery('.btn-reset-password');
                jQuery.ajax({
                    url: `${getBaseURL()}settings/users/${id}/reset_password`,
                    method: 'PATCH',
                    beforeSend: function () {
                        btnLoading($btnConfirm);
                    },
                    success: function (xhr) {
                        reloadDataGrid();
                        toastr.success(xhr.message);
                    },
                    error: HandleJsonErrors,
                    complete: function () {
                        $dialog.modal('hide');
                        btnReset($btnConfirm);
                    }
                });
            }
        }
    })
}


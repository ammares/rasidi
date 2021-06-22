function deleteRole(id) {
    bootbox.confirm({ 
        title: Lang.get('global.confirm'),
        message:Lang.get('global.are_you_sure_to_delete_this_item'),
        size: 'sm',
        onEscape: true,
        backdrop: true,
        swapButtonOrder: true,
        centerVertical: true,
        buttons: {
            confirm: {
                label: Lang.get('global.delete'),
                className: 'btn btn-primary btn-delete'
            },
            cancel: {
                label: Lang.get('global.cancel'),
                className: 'btn btn-link text-secondary'
            }
        },
        callback: function(result){ 
            if(result){
                $btnConfirm = jQuery('.btn-delete');
                jQuery.ajax({
                    url: `${getBaseURL()}settings/roles/${id}`,
                    method: 'DELETE',
                    beforeSend: function () {
                        btnLoading($btnConfirm);
                    },
                    success: function (xhr) {
                        jQuery('tr[data-id="' + id + '"]').fadeTo("normal", 0.01, function(){ 
                            jQuery(this).remove();
                            if(jQuery('.if-empty tr').length==0)
                                jQuery('.if-empty').append(`<td colspan="4">${noDataTemplate()}</td>`);
                        });
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
};
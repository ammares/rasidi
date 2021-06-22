function deleteIntroduction(id) {
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
                    url: `${getBaseURL()}settings/introductions/${id}`,
                    method: 'DELETE',
                    beforeSend: function () {
                        btnLoading($btnConfirm);
                    },
                    success: function (xhr) {
                        jQuery('li[data-id="' + id + '"]').fadeTo("normal", 0.01, function(){ 
                            jQuery(this).remove();
                            if(jQuery('.list-group li').length==0)
                            jQuery('.list-group').append(`<li class="list-group-item">${noDataTemplate()}</li>`);
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
'use strict';

var sortableTable = dragula(
    [document.getElementById('introductions')],
    {
        direction: 'vertical',
        copy: false,
        copySortSource: false,
        revertOnSpill: true,
        removeOnSpill: false
    }
);
var introduction_list = [];
sortableTable.on('drop', function (el) {
    introduction_list = [];
    $('#introductions li').each(function (index) {
        var obj = {};
        obj.id = $(this).data('id');
        obj.order = index + 1;
        introduction_list.push(obj);
    });
    sort_introductions(introduction_list);
});
function sort_introductions(data) {
    jQuery.ajax({
        url: `${getBaseURL()}settings/introductions/sort`,
        method: 'PATCH',
        dataType: "json",
        data: { data },
        success: function (xhr) {
            toastr.success(xhr.message);
        },
        error: HandleJsonErrors,
        complete: function () { }
    });
}

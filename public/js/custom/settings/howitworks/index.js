function deleteHowitworks(id) {
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
                    url: `${getBaseURL()}settings/howitworks/${id}`,
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

var howitworks_list = [];
var sortableHowItWorks = dragula(
    [document.getElementById('howitworks')],
    {
        direction: 'vertical',
        copy: false,
        copySortSource: false,
        revertOnSpill: true,
        removeOnSpill: false
    }
);

sortableHowItWorks.on('drop', function (el) {
    prepareForSort($('#howitworks li'));
});


function prepareForSort(li){
    howitworks_list = [];
    li.each(function (index) {
        var obj = {};
        obj.id = $(this).data('id');
        obj.order = index + 1;
        howitworks_list.push(obj);
    });
    sortHowitworks(howitworks_list);
}
function sortHowitworks(data) {
    jQuery.ajax({
        url: `${getBaseURL()}settings/howitworks/sort`,
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

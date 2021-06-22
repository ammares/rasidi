function deleteKeyfeature(id) {
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
                    url: `${getBaseURL()}settings/keyfeatures/${id}`,
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

var keyfeatures_list = [];
var sortableKeyfeatures = dragula(
    [document.getElementById('keyfeatures')],
    {
        direction: 'vertical',
        copy: false,
        copySortSource: false,
        revertOnSpill: true,
        removeOnSpill: false
    }
);

sortableKeyfeatures.on('drop', function (el) {
    prepareForSort($('#keyfeatures li'));
});


function prepareForSort(li){
    keyfeatures_list = [];
    li.each(function (index) {
        var obj = {};
        obj.id = $(this).data('id');
        obj.order = index + 1;
        keyfeatures_list.push(obj);
    });
    sortKeyfeatures(keyfeatures_list);
}
function sortKeyfeatures(data) {
    jQuery.ajax({
        url: `${getBaseURL()}settings/keyfeatures/sort`,
        method: 'PATCH',
        dataType: "json",
        data: { data },
        success: function (xhr) {
            toastr.success(xhr.message);
            $('#keyfeatures li strong').each(function (index){
                $(this).html(index+1);
            });
        },
        error: HandleJsonErrors,
        complete: function () { }
    });
}

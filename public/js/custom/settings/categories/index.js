var _categories = [];
$(function () {
    'use strict';

    var dt_table_categories = $('.datatables-categories');

    if (dt_table_categories.length) {
        var dt_emailtemplates = dt_table_categories.DataTable({
            ajax: {
                url: getBaseURL() + 'settings/categories',
                type: "GET",
                dataType: "JSON",
                dataSrc: 'data',
                error: HandleJsonErrors
            },
            columns: [
                { data: 'id' },
                { data: 'amount' },
                {
                  data: 'price',
                  render: function (data, type, row, meta) {
                      return row['price']+' SYP';
                  }
                 },
                {
                    data: 'created_at',
                    render: function (data, type, row, meta) {
                        return date('d-m-Y g:i A', strtotime(row['created_at']));
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
                                    <a href="javascript:;" onclick="openCategoryForm(${row['id']})" class="dropdown-item" data-id="${row['id']}" >
                                        ${Lang.get('global.edit')}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:;" class="dropdown-item" data-id="${row['id']}" onclick="deleteCategory(this)">
                                        ${Lang.get('global.delete')}
                                    </a>
                                </div>
                            </div>
                            `
                        );
                    }
                },
            ],
            fnRowCallback: function (nRow, aData, iDisplayIndex) {
                _categories[aData['id']] = aData;
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
                            exportOptions: { columns: [1, 2, 3] }
                        },
                        {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel .csv',
                            className: 'dropdown-item',
                            exportOptions: { columns: [1, 2, 3] }
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

    }
})

function openCategoryForm(id = null) {
    $dialog = bootbox.dialog({
        title: ((id) ? 'Edit Category' : 'Add New Category'),
        message: jQuery('.category-form').html(),
        size: 'md',
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
                    if (id) {
                        jQuery.ajax({
                            url: `${getBaseURL()}settings/categories/${id}/update`,
                            method: 'POST',
                            data: $formData,
                            contentType: false,
                            processData: false,
                            beforeSend: function () {
                                btnLoading($btnConfirm);
                            },
                            success: function (xhr) {
                                toastr.success(xhr.message);
                                $('.datatables-categories').DataTable().ajax.reload();
                                $dialog.modal('hide');
                            },
                            error: HandleJsonErrors,
                            complete: function () {
                                btnReset($btnConfirm);
                            }
                        });
                    } else {
                        jQuery.ajax({
                            url: `${getBaseURL()}settings/categories`,
                            method: 'POST',
                            data: $formData,
                            contentType: false,
                            processData: false,
                            beforeSend: function () {
                                btnLoading($btnConfirm);
                            },
                            success: function (xhr) {
                                toastr.success(xhr.message);
                                $('.datatables-categories').DataTable().ajax.reload();
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

        if (id) {
            userId = id;
            let $categoty = _categories[id];
            jQuery('form', $dialogBody).addClass('was-validated')
                .append(`<input name="_method" type="hidden" value="PATCH">`);
            jQuery('[name="amount"]', $dialogBody).val($categoty.amount);
            jQuery('[name="price"]', $dialogBody).val($categoty.price);
            jQuery('[name="id"]', $dialogBody).val($categoty.id);
        }
    });
}

function deleteCategory($this) {
    let id = jQuery($this).data('id');
    $dialog = bootbox.confirm({
        title: Lang.get('global.confirm'),
        message: `<h5> Do you realy want to delete this categoty?</h5>`,
        swapButtonOrder: true,
        centerVertical: true,
        onEscape: true,
        backdrop: true,
        buttons: {
            confirm: {
                label: Lang.get('global.delete'),
                className: 'btn-ban btn-danger',
            },
            cancel: {
                label: Lang.get('global.cancel'),
                className: 'btn-link text-secondary'
            },
        },
        callback: function ($result) {
            if ($result) {
                jQuery.ajax({
                    url: `${getBaseURL()}settings/categories/${id}/destroy`,
                    method: 'DELETE',
                    beforeSend: function () {
                        btnLoading(jQuery('.btn-ban', $dialog))
                    },
                    success: function (xhr) {
                        toastr.success(xhr.message);
                        $('.datatables-categories').DataTable().ajax.reload();
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

jQuery(document).on('click', '#close-preview', function () {
    jQuery('.image-inline-preview').popover('hide');
    jQuery('.image-inline-preview').hover(
        function () {
            jQuery('.image-inline-preview').popover('show');
        },
        function () {
            jQuery('.image-inline-preview').popover('hide');
        }
    );
});


prepearImagePreview = function () {
    var closebtn = jQuery('<button/>', {
        type: "button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;'
    });
    closebtn.attr("class", "close pull-right");
    jQuery('.image-inline-preview').popover({
        trigger: 'manual',
        html: true,
        title: `<strong'Preview</strong>` + jQuery(closebtn)[0].outerHTML,
        content: Lang.get('global.there_is_no_image'),
        placement: jQuery('.image-inline-preview').data('placement')
    });
    // Clear event
    jQuery('.image-preview-clear').click(function () {
        jQuery('.image-inline-preview').attr("data-content", "").popover('hide');
        jQuery('.image-preview-filename').val("");
        jQuery('.image-preview-clear').hide();
        jQuery('.image-preview-input input:file').val("");
        jQuery(".image-preview-input-title").text('Browse');
    });
    // Create the preview image
    jQuery(".image-preview-input input:file").change(function () {
        var img = jQuery('<img/>', {
            id: 'dynamic',
            width: 250,
            height: 200
        });
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            jQuery(".image-preview-input-title").text('Change');
            jQuery(".image-preview-clear").show();
            jQuery(".image-preview-filename").val(file.name);
            jQuery(".image-inline-preview").attr("data-content", jQuery(img)[0].outerHTML).popover("show");
            jQuery('#dynamic').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    });
};

jQuery(prepearImagePreview);

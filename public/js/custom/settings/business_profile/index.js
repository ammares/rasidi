jQuery(document).ready(function () {
    let previews = ['business-logo'];
    for (var i = 0; i < previews.length; i++) {
        jQuery.uploadPreview({
            input_field: '#' + previews[i] + '-image',
            preview_box: '#' + previews[i] + '-preview',
            label_field: '#' + previews[i] + "-label",
            label_default: `${Lang.get('global.choose_image')}`,
            label_selected: `${Lang.get('global.change_image')}`,
            no_label: false
        });
    }
});
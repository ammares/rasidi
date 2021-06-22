//this file for init the quill-editor and to make it work correctly when submit the form 
//textarea must be Exist after the quill-editor to put the value in it before fore submit

$('.quill-editor').each(function (index) {
    new Quill(this, {
        modules: {
            toolbar: true
        },
        theme: 'snow'
    });
});

$('.save-btn').on('click', function (e) {
    e.preventDefault();
    $('.ql-editor').each(function () {
        let editorField = $(this).parent().data('field');
        $('textarea.' + editorField).html(this.innerHTML);
    });
    $('.quill-form').submit();
});

$((function () {
    "use strict";
    var e = $(".validate-form"),
        n = $(".account-upload-img"),
        a = $(".account-upload");
    a && a.on("change", (function (e) {
        var r = new FileReader, a = e.target.files;
        r.onload = function () {
            n && n.attr("src", r.result)
        },
            r.readAsDataURL(a[0])
    })),
        e.length && e.each((function () {
            var e = $(this); e.validate({
                rules: {
                    name: { required: !0 },
                    email: { required: !0, email: !0 },
                    current_password: { required: !0 },
                    "new_password": { required: !0, minlength: 6 },
                    "new_password_confirmation": { required: !0, minlength: 6, equalTo: "#account-new-password" }
                }
            }),
                e.on("submit", (function (e) { }))
        }))
}));
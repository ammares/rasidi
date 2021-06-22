$("#introduction-upload").on("change", (function (e) {
    n = $("#introduction-upload-img")
   var r = new FileReader, a = e.target.files;
   r.onload = function () { n && n.attr("src", r.result) }, r.readAsDataURL(a[0])
}));

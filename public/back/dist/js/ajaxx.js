function editCategory(id2) {
    $.get('/admin/editcategory/' + id2, function (res) {
        $("#cat_id").val(res.id);
        $("#cat_name").val(res.title);
        $("#cat_slug").val(res.slug);
    });


}

    $(".editCategoryButton").click(function () {

    var data = $("#editCategory").serialize();

    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
    $.ajax({
    method: "POST",
    url: "/admin/category/update",
    data: data,
    dataType: "JSON",
})
    .done(function (response) {
    console.log("Dönen Sonuç: ", response.responseJSON);

    if (response.type == 'success') {
    Swal.fire({
    title: response.title,
    text: response.text,
    icon: response.type,
    confirmButtonText: 'Tamam'
});
    if (response.type == 'success') { // if true (1)
    setTimeout(function () {// wait for 5 secs(2)
    location.reload(); // then reload the page.(3)
}, 2000);
}
} else {

    Swal.fire({
    title: response.title,
    text: response.text,
    icon: response.type,
    confirmButtonText: 'Tamam'
});

}
}).fail(function (response) {
    Swal.fire({
    title: 'HATA!',
    text: 'Logları inceleyin',
    icon: 'error',
    confirmButtonText: 'Tamam'
});
});


});

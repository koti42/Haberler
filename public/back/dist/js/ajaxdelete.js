$(".deleteCategoryButton").click(function () {

    //var data =$("input[data-secim='deleteCategory1']").val();
    //var data = $(this).val();

    var data= 'delete_id='+$(this).val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    Swal.fire({
        title: 'Adamım Gerçekten Silmek İstiyor Musun?',
        text: "Bak bunun geri dönüşü yok!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText:'Hayır, Adamım Silme!',
        confirmButtonText: 'Evet, Sil Lanet Şeyi!!'
    }).then((result) => {





    if (result.isConfirmed) {
        $.ajax({
            method: "POST",
            url: "/admin/category/delete",
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

    }
    });
});


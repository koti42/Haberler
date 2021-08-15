
    const deger = document.getElementById('deger');
    const sonuc = document.getElementById('sonuc');

    const degerYakala = function(e) {

    document.getElementById('sonuc').value=sonuc.innerHTML = e.target.value;
}
    deger.addEventListener('input', degerYakala);



        $(function () {
        bsCustomFileInput.init();
    });
        $(document).ready(function() {
        $('#editor').summernote(
            {
                'height':300,
            }
        );
    });

        const deger2 = document.getElementById('cat_name');
        const sonuc2 = document.getElementById('cat_slug');

        const degerYakala2 = function(e) {

        document.getElementById('cat_slug').value=sonuc2.innerHTML = e.target.value;
    }
        deger.addEventListener('input', degerYakala2);



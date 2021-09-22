<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>KİMLİK DOĞRULAMA</title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'><link rel="stylesheet" href="/back/dist/css/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
    <form id="form" action="{{route('twoFactoryAuth')}}" method="POST">
        @csrf
        <h1>İKİ-ADIMLI DOĞRULAMA-HABER SİTESİ</h1>
        <div class="form__group form__pincode">
            <label>Lütfen Mail Adresinize Gönderilen 6 Karakterli Şifreyi Giriniz</label>
            <input required type="tel" name="pincode[]" maxlength="1" pattern="[\d]*" tabindex="1" placeholder="·" autocomplete="off">
            <input required type="tel"  name="pincode[]" maxlength="1" pattern="[\d]*" tabindex="2" placeholder="·" autocomplete="off">
            <input required type="tel"  name="pincode[]" maxlength="1" pattern="[\d]*" tabindex="3" placeholder="·" autocomplete="off">
            <input required type="tel"  name="pincode[]" maxlength="1" pattern="[\d]*" tabindex="4" placeholder="·" autocomplete="off">
            <input required type="tel" name="pincode[]" maxlength="1" pattern="[\d]*" tabindex="5" placeholder="·" autocomplete="off">
            <input required type="tel"  name="pincode[]" maxlength="1" pattern="[\d]*" tabindex="6" placeholder="·" autocomplete="off">
        </div>

        <div class="form__buttons">
            <button class="button button--primary" type="submit">Onayla</button>
        </div>
    </form>
</div>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/jquery.inputmask.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/jquery-mockjax@2.2.2/src/jquery.mockjax.min.js'></script>
<script  src="/back/dist/js/script.js"></script>

</body>
</html>

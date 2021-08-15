<!doctype html>
<html lang="en">
<head>
    <title>Haber Admin Panel Giriş</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/back/login/css/style.css">

</head>
<body class="img js-fullheight" style="background-image: url(/back/login/images/bg.jpg);">
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Haber Sitesi</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">Bir Hesabınız var mı ?</h3>

                    @if(Session::has('success'))
                        <script>
                            Swal.fire({
                                position: 'middle',
                                icon: 'success',
                                title: 'Şifre Değiştirme Başarılı!',
                                text: '{{ session()->get('success') }}',
                                showConfirmButton: true,
                                confirmButtonText:"Tamam!",
                                timer: 3000

                            })
                        </script>
                    @endif
                <!-- error kısmı default controllerda ki session dan geliyor ve giriş hatalı ise ekrana hatalı mesajını basıyor -->
                    @if(Session::has('error'))
                        <script>
                            Swal.fire({
                                position: 'middle',
                                icon: 'error',
                                title: 'HATA!',
                                text: '{{ session()->get('error') }}',
                                showConfirmButton: true,
                                confirmButtonText:"Tamam!",
                                timer: 3000
                            })
                        </script>
                @endif
                <!--bitiş hata mesajının -->

                    <form action="{{route('Admin.authenticate')}}" class="signin-form" method="post">
                        @csrf
                        <div class="form-group">
                            <!-- old('email') kısmı sayfa gidip geri geldikten sonra beni hatırla seçeneği aktif ise email'i hatırlamaya yarıyor.  -->
                            <input name="email" type="text" class="form-control" placeholder="Kullanici Adi" required
                                   value="{{old('email')}}">
                        </div>
                        <div class="form-group">
                            <input name="password" id="password-field" type="password" class="form-control"
                                   placeholder="Şifre" required>
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Giriş yap</button>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-50">
                                <label class="checkbox-wrap checkbox-primary">Beni hatırla.
                                    <!-- kısa if ile defaultcontroller'da ki request flash'dan seçili veya seçili olmadığına dair bilgi dönünce check atılı veya değil olarak dönüyor.  -->
                                    <input name="remember_me" {{old('remember_me')? 'checked': ''}} type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="w-50 text-md-right">
                                <a href="{{route('reset.password')}}" style="color: #fff">Şifremi unuttum.</a>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</section>

<script src="/back/login/js/jquery.min.js"></script>
<script src="/back/login/js/popper.js"></script>
<script src="/back/login/js/bootstrap.min.js"></script>
<script src="/back/login/js/main.js"></script>

</body>
</html>


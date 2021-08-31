<!doctype html>
<html lang="en">
<head>
    <title>Admin Panel Şifre Değiştir</title>
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
                <h2 class="heading-section">Şifre Değiştirme Sayfası</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">Sifremi Degistir</h3>


                    <form action="" class="signin-form" method="post">
                        @csrf

                                <div class="form-group">
                                    <input name="email" type="text" class="form-control" placeholder="Mail Adresi"
                                           required
                                           value="">
                                </div>
                                <div class="form-group">
                                    <input name="password" id="password-field" type="password" class="form-control"
                                           placeholder="Yeni Şifre" required>
                                    <span toggle="#password-field"
                                          class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>


                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Şifremi Değiştir
                            </button>
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

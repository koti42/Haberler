@extends('admin.layout.master')
@section('content')
@section('title','Kayıt Ekleme')

<html>
<body>


@if(Session::has('success'))
    <script>
        Swal.fire({
            position: 'middle',
            icon: 'success',
            title: 'BAŞARILI!',
            text: '{{ session()->get('success') }}',
            showConfirmButton: true,
            confirmButtonText: "Tamam!",
            timer: 3000

        })
    </script>
@endif
@if(Session::has('error'))
    <script>
        Swal.fire({
            position: 'middle',
            icon: 'error',
            title: 'HATA!',
            text: '{{ session()->get('error') }}',
            showConfirmButton: true,
            confirmButtonText: "Tamam!",
            timer: 3000
        })
    </script>
@endif
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            Swal.fire({
                position: 'middle',
                icon: 'error',
                title: 'HATA!',
                text: '{{$error}}',
                showConfirmButton: true,
                confirmButtonText: "Tamam!",
                timer: 3000
            })
        </script>
    @endforeach
@endif

<form method="POST" action="{{route('users.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <h1>Kayıt ekleme</h1>
        <p>Lütfen Tüm Alanları Doldurunuz.</p>
        <hr>
        <label for="text"><b>İsim</b></label>
        <input type="text" placeholder="İsim Giriniz" name="name" required maxlength="90" minlength="2">

        <label for="email"><b>Email Adresi</b></label>
        <input type="text" placeholder="Mail Giriniz" name="email" required minlength="8" maxlength="90">


        <label for="psw"><b>Şifre</b></label>
        <input type="password" placeholder="Şifre Giriniz" name="password" required maxlength="60" minlength="6">

        <label for="image"><b>Fotoğraf Yükleyiniz </b></label>
        <br>
        <input type="file" placeholder="Dosya Yükleyiniz" name="Image" required>
        <br>
        <br>
        <select name="role_id" style="background: #f1f1f1" class="form-control">

            @foreach($roles as $role)
                @if($role->name!=='Admin')
                    @if($role->name!=='System-Admin')
                        <option style="background-color: #f1f1f1" value="{{ $role->id }}">{{$role->name}}</option>
                    @endif
                @endif
            @endforeach
        </select>
        <button type="submit" class="registerbtn">Kayıt Ekle</button>
    </div>

</form>

</body>
</html>


@endsection

@extends('admin.layout.master')
@section('content')
@section('title','Kayıt Güncelleme')

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
            confirmButtonText:"Tamam!",
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
            confirmButtonText:"Tamam!",
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
                confirmButtonText:"Tamam!",
                timer: 3000
            })
        </script>
    @endforeach
@endif

<form method="POST" action="{{route('users.update',$user)}}">
    @csrf
    @method('PUT')
    <div class="container">
        <h1>Kayıt Güncelleme</h1>
        <p>Lütfen Tüm Alanları Doldurunuz.</p>
        <hr>

        <label for="text"><b>İsim</b></label>
        <input type="text" placeholder="İsim Giriniz"  value ="{{$user->name}}"name="name"  required maxlength="90" minlength="2">

        <label for="email"><b>Email Adresi</b></label>
        <input type="text" placeholder="Mail Giriniz" value ="{{$user->email}}" name="email"  required minlength="8" maxlength="90">
        <button type="submit" class="registerbtn">Kayıt Düzenle</button>
    </div>

</form>

</body>
</html>



@endsection

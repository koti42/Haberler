@extends('admin.layout.master')
@section('content')
@section('title','Role Ekleme')

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

<form method="POST" action="{{route('roles.store')}}">
    @csrf
    <div class="container">
        <h1>Role ekleme</h1>
        <p>Lütfen Tüm Alanları Doldurunuz.</p>
        <hr>
        <label for="text"><b>İsim</b></label>
        <input type="text" placeholder="İsim Giriniz" name="name"  required maxlength="90" minlength="2">
        <label for="text"><b>Admin Sayfasını Görebilir mi ?</b></label>

        <select name="role_id" style="background: #f1f1f1"  class="form-control">
                <option style="background-color: #f1f1f1" value="1">Evet</option>
                <option style="background-color: #f1f1f1" value="0">Hayır</option>
        </select>
        <button type="submit" class="registerbtn">Role Ekle</button>
    </div>

</form>

</body>
</html>



@endsection

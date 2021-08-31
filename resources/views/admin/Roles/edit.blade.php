@extends('admin.layout.master')
@section('content')
@section('title','Rol Güncelleme')

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

<form method="POST" action="{{route('roles.update',$Rol)}}">
    @csrf
    @method('PUT')
    <div class="container">
        <h1>Rol Güncelleme</h1>
        <p>Lütfen Tüm Alanları Doldurunuz.</p>
        <hr>

        <label for="text"><b>İsim</b></label>
        <input type="text" placeholder="İsim Giriniz" value="{{$Rol->name}}" name="name" required maxlength="90"
               minlength="2">
        <input type="hidden" name="role_edit_id" value="{{$Rol->id}}">
        <label for="email"><b>Admin Sayfası Görüntüleyebilsin mi ?</b></label>
        <select name="is_show_admin" style="background: #f1f1f1" class="form-control">
            <option style="background-color: #f1f1f1" value="0" @if(!$Rol->is_show_admin)selected @endif>Hayır</option>

            <option style="background-color: #f1f1f1" value="1" @if($Rol->is_show_admin)selected @endif>Evet</option>


        </select>
        <button type="submit" class="registerbtn">Rolleri Düzenle</button>
    </div>

</form>

</body>
</html>


@endsection

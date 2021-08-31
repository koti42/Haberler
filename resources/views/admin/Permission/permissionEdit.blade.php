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

<form method="POST" action="{{route('permission.update',$Per)}}">
    @csrf
    @method('PUT')
    <div class="container">
        <h1>İzinleri Güncelleme</h1>
        <p>Lütfen Tüm Alanları Doldurunuz.</p>
        <hr>

        <label for="text"><b>Yetki</b></label>
        <input type="text" placeholder="İsim Giriniz"  value ="{{$Per->name}}"name="name"  required maxlength="90" minlength="2">
        <input type="hidden" value="{{$Per->id}}" name="permission_id">
        <button type="submit" class="registerbtn">Kayıt Düzenle</button>
    </div>

</form>

</body>
</html>



@endsection

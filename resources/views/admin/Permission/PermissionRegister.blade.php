@extends('admin.layout.master')
@section('content')
@section('title','İzin Ekleme')

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

<form method="POST" action="{{route('permission.store')}}">
    @csrf
    <div class="container">
        <h1>İzin ekleme</h1>
        <p>Lütfen Tüm Alanları Doldurunuz.</p>
        <hr>
        <label for="text"><b>İzin İsmi</b></label>
        <input type="text" placeholder="İsim Giriniz" name="name"  required maxlength="90" minlength="2">

        <button type="submit" class="registerbtn">Kayıt Ekle</button>
    </div>

</form>

</body>
</html>



@endsection

@extends('admin.layout.master')
@section('content')
    <style>
        .block {
            display: block;
            width: 100%;
            border: none;
            background-color: #9c0e0e;
            color: white;
            padding: 14px 28px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
        }

        .block:hover {
            background-color: #9c0e0e;
            color: white;
        }
    </style>
    <div class="container">
        <div class="container">
            <div class="row">


                @if($finduser->google_id)
                    <div class="col-md-12 row-block">
                        <form action="{{route('GoogleLogout',$finduser->id)}}" method="POST">
                            @csrf
                            <button class="block" type="submit" class="bt btn-danger btn-block">Google Bağlantısını
                                Kes
                            </button>
                        </form>
                    </div>
                @else
                    <div class="col-md-12 row-block">
                        <a class="btn btn-lg btn-primary btn-block" href="{{route('auth.google')}}">
                            <strong>Google İle Bağlan</strong>
                        </a>
                    </div>
                @endif


            </div>
        </div>
    </div>
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
                text: '{{session()->get('error') }}',
                showConfirmButton: true,
                confirmButtonText: "Tamam!",
                timer: 3000
            })
        </script>
    @endif
@endsection

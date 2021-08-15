@extends('admin.layout.master')
@section('content')
@section('title','Kullanıcılar-Admin')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tüm Yetkiler</h3>
                    <div class="float-right">

                    </div>
                    <br>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Ad</th>
                            <th>Sistem Yetkisi mi?</th>
                            <th>Kayıt Tarihi</th>
                            <th>Güncellenme Tarihi</th>
                            <th>Yetki Silme</th>
                            <th>Yetki Düzenleme</th>
                        </tr>
                        </thead>
                        @foreach($Permission as $per)
                            <tr>
                            <tr id="sid"></tr>
                            <td>{{$per->name}}</td>
                            <td>
                                @if($per->is_main===1)
                                   <b>Evet</b>
                                @else
                                   <b>Hayır</b>
                                @endif
                            </td>
                            <td>{{$per->created_at}}</td>
                            <td>{{$per->updated_at}}</td>

                            <td>
                                <form method="post" action="{{route('permission.destroy',$per->id)}}">
                                    @csrf
                                    @method('delete')

                                    @if($per->is_main==0)
                                        <button type="submit" data-secim="deleteUserButton"
                                                id="delete_user" value="" name="delete_id"
                                                class="btn btn-sm btn-danger deleteUserButton">
                                            Yetkiyi Sil
                                        </button>
                                    @else
                                        <b>Yetkiler Silinemez</b>
                                    @endif

                                </form>
                            </td>
                            <td>
                                @if($per->is_main==0)
                                    <button type="submit"
                                            value="" name="update_users"
                                            class="btn btn-sm btn-info"
                                            onclick="window.location.href='{{route('permission.edit',$per->id)}}'">
                                        Yetkiyi Düzenle
                                    </button>
                                    </button>
                                @else
                                    <b>Yetkiler Düzenlenemez</b>
                                @endif

                            </td>
                        @endforeach
                    </table>
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->
        </div>
    {{ $Permission->links('vendor.pagination.custom') }}
    <!-- /.col -->
    </div>
    <!-- /.row -->
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

@endsection

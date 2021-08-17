@extends('admin.layout.master')
@section('content')
@section('title','Kullanıcılar-Admin')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tüm Üyeler</h3>
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
                            <th>Açıklama</th>
                            <th>Sistem Yetkisi mi ?</th>
                            <th>Kayıt Tarihi</th>
                            <th>Admin Sayfası Görüntüleme Yetkisi</th>
                            <th>Rol Sil</th>
                            <th>Rol Düzenle</th>
                            <th>Yetki Ataması</th>
                        </tr>
                        </thead>
                        @foreach($Roles as $role)
                            <tr>
                            <tr id="sid"></tr>
                            <td><b>{{$role->name}}</b></td>
                            <td>
                                {{$role->description}}
                            </td>
                            @if($role->is_main)
                                <td><b>Evet</b></td>
                            @else
                                <td><b>Hayır</b></td>
                            @endif
                            <td>{{$role->created_at}}</td>
                            <td>
                                @if($role->is_show_admin)
                                    <b>Görebilir</b>
                                @else
                                    <b>Göremez</b>
                                @endif
                            </td>
                            <td>
                                <form method="post" action="{{route('roles.destroy',$role->id)}}">
                                @csrf
                                @method('delete')
                                @if($role->is_main==0)
                                    <button type="submit" data-secim="deleteUserButton"
                                            id="delete_user" value="" name="delete_id"
                                            class="btn btn-sm btn-danger deleteUserButton">
                                        Rolü Sil
                                    </button>
                                @else
                                    <b>Roller Silinemez</b>
                                    @endif

                                    </form>
                            </td>
                            <td>
                                @if($role->is_main!==1)
                                    <button type="submit"
                                            value="" name="update_roles"
                                            class="btn btn-sm btn-info"
                                            onclick="window.location.href='{{route('roles.edit',$role->id)}}'">
                                        Rolleri Düzenle
                                    </button>
                                @else
                                    <b>Roller Düzenlenemez</b>
                                @endif
                            </td>
                            <td>
                                <button type="submit"
                                        value="" name="update_roles"
                                        class="btn btn-sm btn-info"
                                        onclick="window.location.href='{{route('roles.manage-permissions',$role->id)}}'">
                                    Yetki Belirle
                                </button>
                            </td>
                        @endforeach
                    </table>
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->
        </div>
    {{ $Roles->links('vendor.pagination.custom') }}
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

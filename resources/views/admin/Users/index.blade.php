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
                                <th>Yetki</th>
                                <th>Email</th>
                                <th>Kayıt Tarihi</th>
                                <th>Admin Sayfası Görüntüleme Yetkisi</th>
                                <th>Mail Doğrulaması Var Mı?</th>
                                <th>Üye Sil</th>
                                <th>Üye Düzenle</th>
                            </tr>
                            </thead>
                            @foreach($users as $user)
                                <tr>
                                <tr id="sid"></tr>
                                <td>{{$user->name}}</td>
                                <td>
                                    @foreach($user->roles as $rols)
                                        <b>{{$rols->name}}</b>
                                    @endforeach
                                </td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    @foreach($user->roles as $rols)
                                        @if($rols->is_show_admin)
                                            <b>Görebilir</b>
                                        @else
                                            <b>Göremez</b>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if($user->email_verified_success==null)
                                        <b>Aktivasyon Yok</b>
                                    @else
                                        <b>Aktivasyon Var</b>
                                    @endif

                                </td>
                                <td>
                                    <form method="post" action="{{route('users.destroy',$user)}}">
                                        @foreach($user->roles as $rols)

                                            @if($rols->name!=='System-Admin'&&$rols->name!=='Admin')
                                                @csrf
                                                @method('delete')

                                                <button type="submit" data-secim="deleteUserButton"
                                                        id="delete_user" value="" name="delete_id"
                                                        class="btn btn-sm btn-danger deleteUserButton">
                                                    Üye Sil
                                                </button>
                                            @else
                                                <b>Üye Silinemez!</b>
                                            @endif
                                        @endforeach
                                    </form>

                                </td>
                                <td>
                                    <button type="submit"
                                            value="" name="update_users"
                                            class="btn btn-sm btn-info"
                                            onclick="window.location.href='{{route('users.edit',$user->id)}}'">
                                        Kullanıcı Düzenle
                                    </button>
                                </td>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>
        {{ $users->links('vendor.pagination.custom') }}
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

@endsection

@extends('admin.layout.master')
@section('content')
@section('title','Rol Yetki Ataması')

<div class="col-lg-12">
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">
                Role Name: {{$role->name}}
            </h6>
        </div>
        <div class="card-body">
            <div class="card-area">
                <h5>Available Permissions</h5>
                @foreach($permissions as $perm)
                    @php $check=0; @endphp
                    <form method="POST" action="{{route('roles.manage-permissionsStore')}}">
                        @csrf
                <div class="col-lg-12">

                        <div class="col-sm-2 float-left ml-5">
                            @foreach($role->permissions as $per)
                                @if($perm->name===$per->name)
                                    @php $check=1; @endphp
                                @endif
                            @endforeach
                            <input type="checkbox" @if($check===1) checked @endif name="permissions[{{$perm->id}}]" id="id-{{$perm->id}}" class="custom-control-input">
                            <label for="id-{{$perm->id}}" class="custom-control-label">{{slugify($perm->name)}}</label>
                        </div>
                        <input type="hidden" name="id" value="{{$role->id}}">


                </div>
                @endforeach
                        <br>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-info" >Rollerin Yetkilerini Kaydet</button>
                    </form>

            </div>
        </div>
    </div>
</div>
@endsection

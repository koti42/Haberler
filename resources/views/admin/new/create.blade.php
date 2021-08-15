@extends('admin.layout.master')
@section('content')
@section('title','News')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Haber Formu</h3>
                </div>

                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
            @endif
            <!-- /.card-header -->
                <!-- form start -->
                <form action="#" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control select2" style="width: 100%;">
                                @foreach($categories as $select)
                                <option>{{$select->title}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Haber Başlığı</label>
                            <input type="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Haber İçeriği</label>
                            <editor2>
                            <textarea name="content" id="editor" class="form-control" rows="4"></textarea>
                            </editor2>
                        </div>

                        <div class="form-group">
                            <label>Haber Fotoğrafı</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Gönder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@append

@section('js')


    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{asset('back/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#editor').summernote(
                {
                    'height': 300,
                }
            );
        });
    </script>
@append

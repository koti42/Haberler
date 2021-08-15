@extends('admin.layout.master')
@section('content')
@section('title','News')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Kategori Formu</h3>
                </div>


                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                @endif


                <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Kategori Adı</label>
                      <input id="deger" type="text"  name="title" class="form-control" required maxlength="250">
                    </div>
                  </div>

                          <input type="hidden" id="sonuc" type="text"  name="slug" class="form-control">


                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Gönder</button>
                  </div>
                </form>
              </div>
      </div>
    </div>
</div>
<script>
    const deger = document.getElementById('deger');
    const sonuc = document.getElementById('sonuc');

    const degerYakala = function(e) {

        document.getElementById('sonuc').value=sonuc.innerHTML = e.target.value;
    }
    deger.addEventListener('input', degerYakala);




</script>
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
    $(document).ready(function() {
  $('#editor').summernote(
      {
          'height':300,
      }
  );
   });
    </script>
@append

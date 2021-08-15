@extends('admin.layout.master')
@section('content')
@section('title','Kategoriler')
<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tüm Kategoriler</h3>
                        <div class="float-right">
                            <a href="{{route('admin.category.create')}}">
                                <button type="button" class="btn btn-primary">Kategori Ekle</button>
                            </a>
                        </div>
                        <br>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Başlık</th>
                                <th>Kategori</th>
                                <th>Tarih</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>

                            @foreach($categories as $category)
                                <tr>
                                <tr id="sid{{$category->id}}"></tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->title }}</td>
                                <td>{{$category->slug }}</td>
                                <td>{{$category->created_at->diffForHumans()}}</td>
                                <td>

                                    <!-- Düzenle butonları -->
                                    <button type="button"
                                            class="btn btn-sm btn-dark">
                                        Şimdilik Boş
                                    </button>
                                    <button type="button" onclick="editCategory({{$category->id}})"
                                            class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalCart">
                                        Düzenleme
                                    </button>

                                    <button type="button" data-secim="deleteCategory1"
                                         id="delete_category" value="{{$category['id']}}" name ="delete_id" class="btn btn-sm btn-danger deleteCategoryButton">
                                        Kategori Sil
                                    </button>
                                </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    @if(Session::has('success'))
        <script>

            Swal.fire({
                position: 'middle',
                icon: 'success',
                title: 'Başarıyla Eklendi.',
                text:'Kayıt İşlemi Başarıyla Tamamlandı.',
                showConfirmButton: false,
                timer: 2000

            })
        </script>
@endif
<!-- Modal güncelleme formu -->

    <!-- Modal: modalCart -->
    <div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Kategori Düzenle</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!--Body-->


                <div class="modal-body" id="modal-body">
                    <form id="editCategory">
                        @csrf
                        <input type="hidden" id="id2" name="category_id">
                        <div class="form-group">
                            <label for=name"">Kategori İsmi</label>
                            <input type="text" class="form-control" id="cat_name" name="cat_name">
                        </div>
                        <div class="form-group">
                            <label for=category2"">Kategori Link</label>
                            <input type="text" class="form-control" id="cat_slug" name="cat_link">
                        </div>
                        <input type="hidden" name="cat_id" value="" id="cat_id">
                        <button type="button" class="btn btn-primary editCategoryButton">Düzenle</button>
                    </form>
                </div>
                <!--Footer-->

            </div>
        </div>
    </div>
    <!-- Modal: modalCart -->
</section>

<script>
    const deger = document.getElementById('cat_name');
    const sonuc = document.getElementById('cat_slug');

    const degerYakala = function(e) {

        document.getElementById('cat_slug').value=sonuc.innerHTML = e.target.value;
    }
    deger.addEventListener('input', degerYakala);

</script>


@endsection


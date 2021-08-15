@extends('admin.layout.master')
@section('content')
@section('title','Haberler')
            <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Tüm Haberler</h3>
                          <div class="float-right">
                            <a href="{{route('admin.category.getAll')}}">
                            <button type="button" class="btn btn-primary">Haber Ekle</button>
                            </a>
                            </div><br>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                              <th>#</th>
                              <th>Resim</th>
                              <th>Başlık</th>
                              <th>Kategori</th>
                              <th>Durum</th>
                              <th>Hit</th>
                              <th>Yazar</th>
                              <th>Tarih</th>
                              <th>İşlemlere</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                              <td>Trident</td>
                              <td>Internet
                                Explorer 4.0
                              </td>
                              <td>Win 95+</td>
                              <td> 4</td>
                              <td>X</td>
                              <td>Trident</td>
                              <td>Trident</td>
                              <td>Trident</td>
                              <td>
                                <a href="#" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                <a href="#" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                                <a href="#" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
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
      </section>
@endsection

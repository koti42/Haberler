<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('back/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('back/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Ara" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{route('admin.dashboard')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Anasayfa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.new')}}" class="nav-link">
                <i class="fas fa-newspaper"></i>
              <p>
                Haberler
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.category')}}" class="nav-link">
                <i class="fab fa-artstation"></i>
              <p>
                Kategoriler
              </p>
            </a>
          </li>

              <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-newspaper"></i>
              <p>
                Kullan??c?? ????lemleri
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('users.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kullan??c?? Listesi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('users.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kullan??c?? Ekle</p>
                </a>
              </li>
                <li class="nav-item">
                    <a href="{{route('roles.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Rol Listele
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('roles.create')}}" class="nav-link">
                        <i class="far fa-calendar-plus nav-icon"></i>
                        <p>
                            Rol Ekle
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('permission.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            ??zinleri Listele
                        </p>
                    </a>
                </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

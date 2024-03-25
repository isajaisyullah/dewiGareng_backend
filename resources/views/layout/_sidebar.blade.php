<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="height: 100%;">
    <!-- Brand Logo -->
    {{-- <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"> Management System</span>
    </a> --}}

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist\img\user1.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info mx-auto text-center">

          @can('view_all')
          <a href="" class="d-block mr-2">SUPERADMIN</a>
          @else
          <a href="" class="d-block mr-2">ADMIN</a>
          @endcan

        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="{{ route('dashboard.index') }}" class="nav-link">
                  <i class="nav-icon fa fa-home"></i>
                  <p>
                    Beranda
                  </p>
                </a>
              </li>
              <li class="nav-item">
                @can('view_all')
                    <a href="{{ route('store.index') }}" class="nav-link">
                @else
                    <a href="{{ route('storeUser.index') }}" class="nav-link">
                @endcan
                  <i class="nav-icon fas fa-store-alt"></i>
                  <p>
                    UMKM
                  </p>
                </a>
              </li>

              <li class="nav-item">
                @can('view_all')
                    <a href="{{ route('product.index') }}" class="nav-link">
                @else
                    <a href="{{ route('productUser.index') }}" class="nav-link">
                @endcan

                  <i class="nav-icon fas fa-boxes"></i>
                  <p>
                    Produk
                  </p>
                </a>
              </li>

              {{-- <li class="nav-item menu-close">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-boxes"></i>
                  <p>
                    Product
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item" style="padding-left: 5%">
                    <a href="{{ route('food.index') }}" class="nav-link" style="width: 98%">
                      <i class="fas fa-cookie ml-1"></i>
                      <p class="ml-2">Makanan</p>
                    </a>
                  </li>
                  <li class="nav-item" style="padding-left: 5%">
                    <a href="#" class="nav-link" style="width: 98%">
                      <i class="fa fa-beer ml-1"></i>
                      <p class="ml-2">Minuman</p>
                    </a>
                  </li>
                  <li class="nav-item" style="padding-left: 5%">
                    <a href="#" class="nav-link" style="width: 98%">
                      <i class="fa fa-cube ml-1"></i>
                      <p class="ml-2">Barang</p>
                    </a>
                  </li>
                </ul>
              </li> --}}
                @can('view_all')
                <li class="nav-item">
                    <a href="{{ route('wisata.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-umbrella-beach"></i>
                    <p>
                        Wisata
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('galeri.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-book-reader"></i>
                    <p>
                        Galeri Artikel
                    </p>
                    </a>
                </li>
                @endcan
        </ul>
      </nav>

        <div class="mt-1 pb-1 mb-3 d-flex" style="position: fixed; border-color: white;bottom: 0;z-index: 1000; width: 100%;">
            <ul class="nav nav-pills nav-sidebar flex-column mb-2" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add a new list item for the logout link at the bottom -->
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="confirmLogout()">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Keluar
                        </p>
                    </a>
                </li>
            </ul>
        </div>
            <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <script>
    function confirmLogout() {
        var confirmLogout = confirm("Are you sure you want to logout?");
        if (confirmLogout) {
            // If the user confirms, redirect to the logout route
            window.location.href = "{{ route('logout') }}";
        } else {
            // If the user cancels, do nothing
        }
    }
    </script>


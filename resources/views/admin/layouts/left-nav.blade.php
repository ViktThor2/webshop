  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="img/logo.png" alt="Audio Life  Logo" style="width: 230px"; height="120px">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          {{-- Termékkezelő --}}     
          <li class="nav-header">Adminisztráció</li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Termékkezelő
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('termék-lista')<li class="nav-item">
                <a href="{{ route('product.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Termékek</p>
                </a>
              </li>@endcan
              @can('kategória-lista')<li class="nav-item">
                <a href="{{ route('category.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategóriák</p>
                </a>
              </li>@endcan
              @can('márka-lista')<li class="nav-item">
                <a href="{{ route('brand.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Márkák</p>
                </a>
              </li>@endcan
              @can('mennyiségi-egység-lista')<li class="nav-item">
                <a href="{{ route('unit.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mennyiségi egységek</p>
                </a>
              </li>@endcan
            </ul>
          </li>
          {{-- Termékkezelő vége --}}

          {{-- Felhasználókezelő --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Felhasználókezelő
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('felhasználó-lista')<li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Felhasználók</p>
                </a>
              </li>@endcan
              @can('szerep-lista')<li class="nav-item">
                <a href="{{ route('role.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Szerepek</p>
                </a>
              </li>@endcan
              @can('jogosultság-lista')<li class="nav-item">
                <a href="{{ route('permission.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jogosultságok</p>
                </a>
              </li>@endcan
            </ul>
          </li>
          {{-- Felhasználókezelő vége --}}

          {{-- Rendeléskezelő --}}
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Rendeléskezelő
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- Rendeléskezelő vége --}}          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

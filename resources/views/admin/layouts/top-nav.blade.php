<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">

    <li class="nav-item">
      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Kijelentkezés
      </a>
    </li> 

  </ul>
  
</nav>
<!-- /.navbar -->

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Biztos ki szeretne jelentkezni?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Vissza</button>
          <form method="post" action="{{ route('logout') }}">
                @csrf
            <input type="submit" class="btn btn-primary" value="Kijelentkezés">
          </form>
        </div>

      </div>
    </div>
  </div>
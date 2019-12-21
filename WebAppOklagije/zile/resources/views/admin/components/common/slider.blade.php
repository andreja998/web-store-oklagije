<!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="{{ asset('/admin/home') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Pocetna</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Stranice</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Administriranje korisnika:</h6>
          <a class="dropdown-item" href="{{ asset('/admin/order') }}">Narudzbine</a>
          <a class="dropdown-item" href="{{ asset('/admin/users') }}">Korisnici</a>
          <a class="dropdown-item" href="{{ asset('/admin/comment') }}">Komentari</a>
          <a class="dropdown-item" href="{{ asset('/admin/feed') }}">Utisci</a>
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Administriranje sajta:</h6>
          <a class="dropdown-item" href="{{ asset('/admin/action') }}">Popusti</a>
          <a class="dropdown-item" href="{{ asset('/admin/news') }}">Vesti</a>
          <a class="dropdown-item" href="{{ asset('/admin/category') }}">Kategorije</a>
          <a class="dropdown-item" href="{{ asset('/admin/products') }}">Proizvodi</a>
          <a class="dropdown-item" href="{{ asset('/admin/slider') }}">Slajderi</a>
        </div>
      </li>
    </ul>
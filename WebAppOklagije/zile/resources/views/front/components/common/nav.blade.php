<nav class="navbar sticky-top navbar-expand-md navbar-light bg-light">
     <a class="navbar-brand" href="{{ asset('/') }}"><h1>SveoDrveta</h1></a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          <h5 id="navCart"></h5>
     </button>

     <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto" id="navbarNav" style="list-style: none;">
               <li class="nav-item {{ ($url == route('home')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ asset('/') }}">Početna
                         <span class="sr-only">(current)</span>
                    </a>
               </li>
               <li class="nav-item">
                    <a class="nav-link {{ ($url == asset('/products')) ? 'active' : '' }}" href="{{ asset('/products') }}">Proizvodi</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link {{ ($url == asset('/news')) ? 'active' : '' }}" href="{{ asset('/news') }}">Novosti</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link {{ ($url == asset('/contact')) ? 'active' : '' }}" href="{{ asset('/contact') }}">Kontakt</a>
               </li>
          </ul>

          <ul class="navbar-nav ml-md-auto" style="list-style: none;">
               @if(!session()->has('korisnik'))
               <li class="nav-item">
                    <a class="nav-link" onclick="prijavaRegistracija();" href="#self">
                    <i class="fa fa-user"></i> Prijava</a>
               </li>
               @else
               <li class="nav-item">
                    <a class="nav-link" href="{{ asset('/logout') }}">Odjava</a>
               </li>
               @endif
               <li class="nav-item">
                    <a id="cart" class="nav-link uimio" href="{{ asset('/cart') }}">
                         <i class="fa fa-shopping-cart"> Korpa <h5>0</h5></i>
                    </a>
               </li>
          </ul>
     </div>
     </ul>
</nav>
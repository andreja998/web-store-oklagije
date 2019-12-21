<div class="row pt-4">
     @foreach($kategorije as $kategorija)
          <div class="col-md-4 mt-4">
               <a class="filter" data-indeks="{{ $kategorija->id }}" href="#self">
                    <div class="card text-white">
                              <div class="wrapper-slika">
                                   <img class="card-img" src="{{ asset('/'.$kategorija->src) }}" style="filter: brightness(80%);" alt="{{ $kategorija->naziv }}"/>
                              </div>
                              <div class="kategorija-proizvoda">
                                   <h5 class="text-center text-white">
                                        <i class="fa fa-plus-square"></i> {{ $kategorija->namena }}</h5>
                                   <h3 class="card-title pt-2 text-center text-white">
                                             <strong>{{ $kategorija->naziv }}</strong>
                                   </h3>
                              </div>
                         </div>
               </a>
          </div>
     @endforeach
     <div class="col-md-4 mt-4">
          <a class="filterAll" href="#">
               <div class="card text-white">
                    <div class="wrapper-slika">
                         <img class="card-img" src="slike/skockica.jpg" style="filter: brightness(80%);" alt="sviProizvodi"/>
                    </div>
                    <div class="kategorija-proizvoda">
                         <h5 class="text-center text-white">
                              <i class="fa fa-plus-square"></i> Svi naši</h5>
                         <h3 class="card-title pt-2 text-center text-white">
                              <strong>PROIZVODI</strong>
                         </h3>
                    </div>
               </div>
          </a>
     </div>
</div>
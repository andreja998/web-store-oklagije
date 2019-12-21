<div class="row mt-2">
     @foreach($proizvodi as $proizvod)
     <div class="col-md-4 mt-4">
          <a href="{{ asset('/product/'.$proizvod->id) }}">
               <div class="card">
                    <div class="wrapper-slika">
                         <img class="card-img" src="{{ asset('/'.$proizvod->src[0]->src) }}" alt="{{ $proizvod->src[0]->alt }}">
                    </div>
                    <div class="card-body">
                         <a class="title-link" href="{{ asset('/product/'.$proizvod->id) }}" ><h4 class="card-title">{{ $proizvod->naziv }}</h4></a>
                         <div class="options d-flex flex-fill align-items-center">
                              <div class="quantity">
                                   <input class="text-center pr-4" type="number" min="1" max="50" step="1" value="1"/>
                              </div>
                         </div>
                         <div class="buy d-flex justify-content-between align-items-center">
                              <div class="price text-success">
                                   <h5 class="mt-4">{{ $proizvod->cena - $proizvod->cena * $proizvod->popust / 100 }} rsd.</h5>
                                   @if($proizvod->popust != 0)
                                        <del>{{ $proizvod->cena }} rsd.</del>
                                   @endif
                              </div>
                              <!-- dodati link za korpu -->
                              <a href="#self" data-indeks="{{ $proizvod->id }}" class="dodaj-u-korpu btn btn-danger mt-3">Dodaj u korpu</a>
                         </div>
                    </div>
                    <input type="hidden" name="kategorija" class="kategorija" value="{{ $proizvod->id_kategorije }}" />
               </div>
          </a>
     </div>
     @endforeach
</div>
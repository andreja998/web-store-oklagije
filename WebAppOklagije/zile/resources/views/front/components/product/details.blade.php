<div class="row">
       <div class="col-md-5 mt-4">
            <div class="cars-gallery">
                 <div class="swiper-container gallery-top">
                      <div class="swiper-wrapper">
                        @foreach($proizvod[0]->src as $img)
                           <div class="swiper-slide">
                                <div class="swiper-zoom-container wrapper-thumbnail">
                                     <img src="{{ asset('/'.$img->src) }}" alt="{{ $img->alt }}"/>
                                </div>
                           </div>
                        @endforeach
                      </div>
                      <!-- Add Arrows -->
                      <div class="swiper-button-next swiper-button-black"></div>
                      <div class="swiper-button-prev swiper-button-black"></div>
                 </div>
                 <div class="swiper-container gallery-thumbs">
                      <div class="swiper-wrapper">
                        @foreach($proizvod[0]->src as $img)
                           <div class="swiper-slide">
                                <div class="swiper-zoom-container wrapper-thumbnail">
                                     <img src="{{ asset('/'.$img->src) }}" alt="{{ $img->alt }}"/>
                                </div>
                           </div>
                        @endforeach
                      </div>
                 </div>
            </div>

       </div>
       <div class="col-md-7 pl-4 mt-4 deskripcija">
            <h6 class="kategorija pr-1 pt-1">kategorija /</h6>
            <h5 class="kategorija-naslov">{{ $proizvod[0]->kategorija }}</h5>

            <h2 class="naziv-proizvoda pt-3">{{ $proizvod[0]->naziv }}</h2>
            <div class="price text-success">
                 <h5 class="mt-2">{{ $proizvod[0]->cena - $proizvod[0]->cena * $proizvod[0]->popust / 100}} RSD @if($proizvod[0]->popust != 0)<del>{{ $proizvod[0]->cena }} RSD</del>@endif </h5> <h3>({{ $proizvod[0]->euro - $proizvod[0]->euro * $proizvod[0]->popust / 100 }}&euro;) @if($proizvod[0]->popust != 0)<del>{{ $proizvod[0]->euro }} &euro;</del>@endif</h3>
            </div>
            <!-- ocene -->
            <div class="recenzije pl-1">
              @if(session()->has('korisnik')) <input type="hidden" id="korisnik" name="korisnik" value="{{ session()->get('korisnik')[0]->id }}" /> @endif
                @for($i=1; $i<=5; $i++)
                  @if($proizvod[0]->ocena >= $i)
                    <span id="star_{{$i}}" class="fa fa-star checked"></span>
                  @else
                    <span id="star_{{$i}}" class="fa fa-star"></span>
                  @endif
                @endfor
                <i>{{ number_format($proizvod[0]->ocena, 2) }}</i>     

            </div>
            <p class="tekst-deskripcije pt-3">{{ $proizvod[0]->opis }}
            </p>
            <div class="options d-flex flex-fill align-items-center">
                 <div class="quantity quantity-detalji">
                      <input class="text-center pr-4" type="number" min="1" max="50" step="1" value="1" />
                 </div>
            </div>
            <!--dodati link za dodavanje u korpu-->
            <div class="buy d-flex justify-content-between align-items-center">
                 <a href="#self" data-indeks="{{ $proizvod[0]->id }}" class="btn btn-danger mt-3 dodaj-iz-proizvoda">Dodaj u korpu</a>
            </div>
       </div>
  </div>
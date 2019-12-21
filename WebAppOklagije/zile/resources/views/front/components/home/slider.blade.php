<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
     <ol class="carousel-indicators">
          @for($i=0; $i < count($slajderi); $i++)
               <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" class="{{ ($i == 0) ? 'active' : '' }}"></li>
          @endfor
     </ol>
     <div class="carousel-inner" role="listbox">
          @foreach($slajderi as $slajder)
               <div class="carousel-item  {{ ($loop->first) ? 'active' : '' }}">
                    <div class="wrapper-slika">
                         <img src="{{ $slajder->src }}" alt="{{'slider'.$loop->index }}" style="filter: brightness(80%); max-height: 70vh;" />
                    </div>
                    <div class="carousel-caption d-none d-md-block">
                         <h3 class="animated fadeInLeft">{{ $slajder->naslov }}</h3>
                         <p class="animated fadeInRight">{{ $slajder->opis }}</p>
                    </div>
               </div>
          @endforeach
     </div>
     <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
     </a>
     <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
     </a>
</div>
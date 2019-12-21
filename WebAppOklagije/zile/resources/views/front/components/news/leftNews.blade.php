<div class="row novost novost-nepar mt-3">
     <div class="col-md-7 col-sm-12 pt-3 pb-3 pr-3 pl-4">
          <h3>{{ $vest->naslov }}</h3>
          <h6>{{ date('d.m.Y.',$vest->datum) }}</h6>
          <p>{{ $vest->tekst }}</p>
     </div>
     <div class="col-md-5 slika-novosti" style="background-image: url('{{ $vest->src }}');">
     </div>
</div>
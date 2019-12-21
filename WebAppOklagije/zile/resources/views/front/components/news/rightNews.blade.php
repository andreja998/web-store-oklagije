<div class="row novost novost-par mt-3">
     <div class="col-md-5 col-sm-12 slika-novosti" style="background-image: url('{{ $vest->src }}');">
     </div>
     <div class="col-md-7 novost-sadrzaj pt-3 pb-3 pr-3 pl-4">
          <h3>{{ $vest->naslov }}</h3>
          <h6>{{ date('d.m.Y.',$vest->datum) }}</h6>
          <p>{{ $vest->tekst }}</p>
     </div>
</div>
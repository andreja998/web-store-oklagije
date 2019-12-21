@foreach($topVest as $vest)
<div class="glavna-vest">
     <img src="{{ $vest->src }}" alt="{{ $vest->naslov }}"/>
     <div class="sadrzaj">
          <h1 class="animated fadeInLeft">
              {{ $vest->naslov }}
          </h1></br>
          <p class="animated fadeInRight">{{ $vest->tekst }}</p>
     </div>
</div>
@endforeach
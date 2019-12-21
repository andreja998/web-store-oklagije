@if(count($utisci) != 0 || (session()->has('korisnik')))
     <div class="utisak-naslov text-center mb-3">
          <div>
               <hr/>
          </div>
     </div>
@endif
<div class="row mt-4">
      @foreach($utisci as $utisak)
<div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="image-flip" on-touch="this.classList.toggle('hover');">
                         <div class="mainflip">
                              <div class="frontside">
                                   <div class="card">
                                        <div class="card-body text-center">
                                             <p>
                                                  <img class=" img-fluid" src="slike/slider/drvo4.jpg" alt="feedback">
                                             </p>
                                             <h4 class="card-title">{{ $utisak->username }}</h4>
                                        </div>
                                   </div>
                              </div>
                              <div class="backside">
                                   <div class="card">
                                        <div class="card-body text-center mt-4 align-items-center">
                                             <h4 class="card-title">{{ $utisak->username }}</h4>
                                             <p id="card" class="card-text ">{{ $utisak-> tekst }}</p>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
     @endforeach
     @if(session()->has('korisnik'))
          <div class="status-upload mb-2">
               <form action="{{ asset('/feedback') }}" method="post">
                    {{ csrf_field() }}
                    <textarea name="utisak" placeholder="Unesite vaš utisak"></textarea>
                    <input type="hidden" name="korisnik" value="{{ session()->get('korisnik')[0]->id }}" />
                    <button type="submit" class="float-right btn text-white btn-primary ml-2 mb-2">
                         <i class="fa fa-send text-white"></i> Pošalji
                    </button>
               </form>
          </div>
     @endif
</div>
@if(count($proizvod[0]->comments) != 0 || session()->has('korisnik'))
<div class="utisak-naslov text-center mb-3">
               <div>
                    <hr/>
               </div>
          </div>
          @endif
          @if(session()->has('korisnik'))
          <div class="row">

               @if(session()->has('error'))
                 <div class="col-md-6 col-lg-12 mt-4 alert alert-danger d-flex text-center justify-content-center">
                     {{ session('error') }}
                 </div>
               @endif

               <!-- malo bolje stilizovati prikaz poruke -->
               @if($errors->any())
                 <div class="col-md-6 col-lg-12 mt-4 d-flex text-center justify-content-center">
                     <ul class="list-group">
                         @foreach($errors->all() as $error)
                             <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                         @endforeach
                     </ul>
                 </div>
               @endif

                <p>
                    <div class="status-upload mb-2">
                         <form action="{{ asset('/comment') }}" method="post">
                              {{ csrf_field() }}
                              <textarea name="komentar" placeholder="Unesite komentar ovde"></textarea>
                              <input type="hidden" name="proizvod" value="{{ $proizvod[0]->id }}" />
                              <button type="submit" class="float-right btn text-white btn-primary ml-2 mb-2">
                                   <i class="fa fa-comment text-white"></i> Komentariši
                              </button>
                         </form>
                    </div>
               </p>
          </div>
          @endif
          <div class="row komentari">
               <div class="col">
                    @foreach($proizvod[0]->comments as $comment)
                    <div class="card mt-4">
                         <div class="card-body">
                              <div class="row">
                                   <div class="col-md-2">
                                        <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" alt="user" />
                                        <p class="text-secondary text-center">{{ date('d.m.Y.',$comment->datum) }}</p>
                                   </div>
                                   <div class="col-md-10">
                                        <p>
                                           <h6 class="float-left">
                                                <strong>{{ $comment->imePrezime }}</strong>
                                           </h6>
                                        </p>
                                        <div class="clearfix"></div>
                                        <p>{{ $comment->tekst }}</p>
                                   </div>
                              </div>
                              <!-- odgovor -->
                              @isset($comment->odgovor)
                              <div class="card card-inner mt-2">
                                   <div class="card-body">
                                        <div class="row">
                                             <div class="col-md-2">
                                                  <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" alt="admin" />
                                                  <p class="text-secondary text-center">{{ date('d.m.Y.',$comment->odgDatum) }}</p>
                                             </div>
                                             <div class="col-md-10">
                                                  <p>
                                                       <a href="https://maniruzzaman-akash.blogspot.com/p/contact.html">
                                                            <strong>Administrator</strong>
                                                       </a>
                                                  </p>
                                                  <p>{{ $comment->odgovor }}</p>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              @endisset
                         </div>
                    </div>
                    @endforeach
               </div>

          </div>
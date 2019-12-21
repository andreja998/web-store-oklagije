<div id="prijava-registracija">
     <div class="container prijava-registracija">
          <div class="row">
               <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div id="prijava" class="card card-signin my-5 animated fadeInLeft">
                         <span class="closes">&times;</span>
                         <div class="card-body">
                              <h5 class="card-title text-center">Prijava</h5>
                              <form action="{{ asset('/login') }}" method="post" class="form-signin">
                                   {{ csrf_field() }}
                                   <div class="form-label-group">
                                        <input type="text" id="username" name="korisnickoIme" class="form-control klasa" placeholder="Korisnicko ime" required autofocus/>
                                        <label for="username">Korisničko ime</label>
                                   </div>

                                   <div class="form-label-group">
                                        <input type="password" id="inputPassword" name="lozinka" class="form-control klasa" placeholder="Šifra" required>
                                        <label for="inputPassword">Šifra</label>
                                   </div>
                                   <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Prijavite se</button>
                                   <hr class="my-4">
                                   <a onclick="registracijaToggle();" class="link">Nemate nalog? Registrujte se.</a>
                                   <a href="{{ asset('/contact') }}">Zaboravili ste lozinku</a>
                              </form>
                         </div>
                    </div>

                    <div id="registracija" class="card card-signin my-5 animated fadeInLeft">
                         <span class="closes">&times;</span>
                         <div class="card-body">
                              <h5 class="card-title text-center">Registracija</h5>
                              <form action="{{ asset('/registration') }}" method="post" class="form-signin">
                                   {{ csrf_field() }}
                                   <div class="form-label-group">
                                        <input type="text" id="inputFullName" name="fullName" class="form-control" placeholder="Ime i prezime" required autofocus/>
                                        <label for="inputFullName">Ime i prezime</label>
                                   </div>
                                   <div class="form-label-group">
                                        <input type="text" id="inputUsername" name="korisnickoIme" class="form-control" placeholder="Korisnicko ime" required autofocus />
                                        <label for="inputUsername">Korisničko ime</label>
                                   </div>
                                   <div class="form-label-group">
                                        <input type="email" id="tbEmail" name="email" class="form-control" placeholder="E-mejl adresa" required autofocus />
                                        <label for="tbEmail">E-mejl adresa</label>
                                   </div>
                                   <div class="form-label-group">
                                        <input type="password" id="tbPassword" name="lozinka" class="form-control" placeholder="Šifra" required />
                                        <label for="tbPassword">Šifra</label>
                                   </div>

                                   <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Registrujte se</button>
                                   <hr class="my-4">
                                   <a onclick="prijavaToggle();" class="link">Imate nalog? Prijavite se.</a>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
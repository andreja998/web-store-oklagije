@extends('front.layout.template')

@section('content')
	<div class="container mt-4">
		<div class="row">
			<div class="col-md-4">
		   <div class="levi ml-4 mt-4">
		        <a>
		            <i class="fa fa-home mr-2"></i>Adresa: Milene Pavlović Barili 3
		        </a></br>
		        <p>Lajkovac 14224</p>
		        <a>
		            <i class="fa fa-phone mr-2"></i> 065 522 262 28
		        </a></br>
		        <a>
		            <i class="fa fa-envelope mr-2"></i> prodajaoklagija@gmail.com
		        </a>

		        <p>Očekujte odgovor na vašoj e-mail adresi.</p>
		        <hr/>
		        <b>Ukoliko ste zaboravili lozinku, pišite našem administratoru i očekujte odgovor na vašoj e-mail adresi.</b>
		   </div>
		   <div class="levi mt-4">
		   @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div>
                        <ul class="list-group">
                            @foreach($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
		   <div class="col-md-8 mt-4">
                <h3>Pitanja u vezi proizvoda</h3>
		        <form action="{{ asset('/sendmessage') }}" method="post">
		        	{{ csrf_field() }}
		             <div class="form-group">
		                  <label for="tbImePrezime">Ime i prezime</label>
		                  <input type="text" class="form-control" id="tbImePrezime" name="tbImePrezime" aria-describedby="emailHelp" placeholder="Unesite vaše ime i prezime" required />
		                  <small id="emailHelp" class="form-text text-muted">Unesite ime i prezime</small>
		             </div>
		             <div class="form-group">
		                  <label for="mail">E-mejl adresa</label>
		                  <input type="email" class="form-control" id="mail" name="tbEmail" aria-describedby="emailHelp" placeholder="Unesite e-mejl" required />
		                  <small id="emailHelp" class="form-text text-muted">Nikada nećemo podeliti vaš mejl sa nekim.</small>
		             </div>
		             <div class="form-group">
		                  <label for="taPoruka">Tekst</label>
		                  <textarea class="form-control" id="taPoruka" name="tekst" rows="3"></textarea>
		             </div>
		             <button type="submit" class="btn btn-primary" style="float: right;">Potvrdite</button>
		        </form>
		   </div>
		</div>
    </div>
@endsection
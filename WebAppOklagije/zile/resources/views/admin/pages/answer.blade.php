@extends('admin.layout.template')

@section('content')
	@isset($komentar)
		<div class="container">

		    <p>Postavio:<h3>{{ $komentar->username }}</h3></p>

		    <p>Proizvod: {{ $komentar->naziv }}</p>

		    <hr/>

		    <p>tekst: <h5>{{ $komentar->tekst }}</h5></p>

		    <hr/>

		    <h6>Datum: {{ date('d.m.Y.', $komentar->datum) }}</h6>

		    <hr/>
		    <div class="row">
		    		<h3>Vas odgovor:</h3>
		    <div class="status-upload mb-2">
	               <form action="{{ asset('/answer/send') }}" method="post">
	                    {{ csrf_field() }}
	                    <textarea name="odgovor" placeholder="Unesite vaš odgovor"></textarea>
	                    <input type="hidden" name="komentar" value="{{ $komentar->id }}" />
	                    <button type="submit" class="float-right btn text-white btn-primary ml-2 mb-2">
	                         <i class="fa fa-send text-white"></i> Pošalji
	                    </button>
	               </form>
	          </div>
	      </div>
		</div>
	@endisset
@endsection
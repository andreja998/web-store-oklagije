@extends('admin.layout.template')

@section('content')
	@isset($poruka)
		<div class="container">

		    <p>Poslao:<h3>{{ $poruka->imePrezime }}</h3></p>

		    <p>{{ $poruka->email }}</p>

		    <hr/>

		    <p>Sadržaj: <h5>{{ $poruka->tekst }}</h5></p>

		    <hr/>

		    <h6>Datum: {{ date('d.m.Y.', $poruka->datum) }}</h6>

		    <div class="row">
		    	<div class="col-md-3 justify-content-end">
				    <a href="{{ asset('admin/deleteMessage/'.$poruka->id) }}" class="btn btn-danger btn-block">
				    	Izbrisi <i class="fa fa-trash"></i>
		            </a>
		        </div>
	        </div>
		</div>
	@endisset
@endsection
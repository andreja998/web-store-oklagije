@extends('admin.layout.template')

@section('content')
	@isset($product)
		<div class="container">

		    <p>Proizvod:<h3>{{ $product[0]->kategorija.' '.$product[0]->naziv }}</h3></p>

		    <p>{{ $product[0]->opis }}</p>

		    <hr/>

		    <p>Cena: <h5>{{ $product[0]->cena }}rsd. - {{ $product[0]->euro }}&euro;</h5></p>

		    <p>Popust: @if($product[0]->popust != 0) {{ $product[0]->popust }}% @else Bez popusta @endif</p>

		    <hr/>

		    <h6>Slike:</h6>

		    @foreach($product[0]->src as $slika)
		    	<img src="{{ asset($slika->src) }}" alt="{{ $slika->alt }}">
		    @endforeach

		    <div class="row">
		    	<div class="col-md-3 justify-content-end mt-4 mb-4">
				    <a href="{{ asset('admin/updateProduct/'.$product[0]->id) }}" class="btn btn-warning btn-block">
				    	Izmeni
		            </a>
		        </div>
	        </div>
		</div>
	@endisset
@endsection
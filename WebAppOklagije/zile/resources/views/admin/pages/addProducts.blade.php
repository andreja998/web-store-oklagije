@extends('admin.layout.template')

@section('content')
<div class="container">
	<div class="row">
	   <div class="col-md-8 mt-4">
		<h4>Dodaj proizvode za popust</h4>
	        <form action="{{ asset('/action/addProducts/'.$popustId) }}" method="post">
	        	{{ csrf_field() }}
	             <div class="form-row">
	                  <div class="form-group col-md-6">
	                       <label for="proizvodi">Proizvodi</label>
	                       <select class="form-control d-flex" id="mProizvodi" name="mProizvodi[]" multiple="multiple">
	                       	@foreach($products as $product)
                              	<option value="{{ $product->id }}">{{ $product->naziv }}</option>
                              @endforeach
                         </select>
	                  </div>
	             </div>
	             <div class="form-row">
	                  <div class="form-group col-md-6">
	                       <button type="submit" class="float-right btn text-white btn-primary ml-2 mb-2">Unesi</button>
	                  </div>
	             </div>
	        </form>
	   </div>
	</div>
</div>
@endsection
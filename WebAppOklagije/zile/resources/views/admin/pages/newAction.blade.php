@extends('admin.layout.template')

@section('content')
<div class="container">
	<div class="row">
	   <div class="col-md-8 mt-4">
		<h4>Kreiranje novog popusta</h4>
	        <form action="{{ asset('/action/insert') }}" method="post">
	        	{{ csrf_field() }}
	             <div class="form-row">
	                  <div class="form-group col-md-6">
	                       <label for="popust">Popust</label>
	                       <input type="number" class="form-control" name="popust" id="popust" aria-describedby="emailHelp" placeholder="Unesite popust (bez %)"/>
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
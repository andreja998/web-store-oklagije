@extends('admin.layout.template')

@section('content')
<div class="container">
	<div class="row">
	   <div class="col-md-8 mt-4">
		<h4>Dodaj novi slajd</h4>
	        <form action="{{ asset('/slider/insert') }}" method="post" enctype="multipart/form-data">
	        	{{ csrf_field() }}
	             <div class="form-row">
	                  <div class="form-group col-md-8">
                           <label for="naslov">Naslov</label>
                           <input type="text" class="form-control" id="naslov" name="naslov" aria-describedby="emailHelp" placeholder="Unesite naslov">
                      </div>
	             </div>
	             <div class="form-row">
                      <div class="form-group col-md-8">
                           <label for="opis">Opis</label>
                           <input type="text" class="form-control" id="opis" name="opis" aria-describedby="emailHelp" placeholder="Unesite opis">
                      </div>
	             </div>
	             <div class="form-row">
                      <div class="form-group col-md-8">
                           <label for="slika">Slika</label>
                           <input type="file" class="form-control-file" name="slika" id="slika"/>
                      </div>
                 </div>
	             <div class="form-row">
	                  <div class="form-group col-md-8">
	                       <button type="submit" class="float-right btn text-white btn-primary ml-2 mb-2">Unesi</button>
	                  </div>
	             </div>
	        </form>
	   </div>
	</div>
</div>
@endsection
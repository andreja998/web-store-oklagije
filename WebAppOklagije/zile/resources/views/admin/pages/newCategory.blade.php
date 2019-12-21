@extends('admin.layout.template')

@section('content')
<div class="container">
	<div class="row">
	   <div class="col-md-8 mt-4">
		<h4>Dodaj novu kategoriju</h4>
	        <form action="{{ asset('/category/insert') }}" method="post" enctype="multipart/form-data">
	        	{{ csrf_field() }}
	             <div class="form-row">
	                  <div class="form-group col-md-8">
                           <label for="naziv">Naziv</label>
                           <input type="text" class="form-control" id="naziv" name="naziv" aria-describedby="emailHelp" placeholder="Unesite naziv kategorije">
                      </div>
	             </div>
	             <div class="form-row">
                      <div class="form-group col-md-8">
                           <label for="namena">Namena</label>
                           <input type="text" class="form-control" id="namena" name="namena" aria-describedby="emailHelp" placeholder="Unesite namenu kategorije">
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
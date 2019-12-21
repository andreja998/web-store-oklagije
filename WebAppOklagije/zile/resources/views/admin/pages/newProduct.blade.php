@extends('admin.layout.template')

@section('content')
<div class="container">
	<div class="row">
	   <div class="col-md-8 mt-4">
		<h4>Dodaj Proizvod</h4>
	        <form action="{{ asset('/products/insert') }}" method="post" enctype="multipart/form-data">
	        	{{ csrf_field() }}
	             <div class="form-row">
	                  <div class="form-group col-md-8">
                           <label for="naziv">Naziv</label>
                           <input type="text" class="form-control" id="naziv" name="naziv" aria-describedby="emailHelp" placeholder="Unesite naziv">
                      </div>
	             </div>
	             <div class="form-row">
                      <div class="form-group col-md-8">
                           <label for="opis">Opis</label>
                           <textarea class="form-control" id="opis" name="opis" placeholder="Unesite opis"></textarea>
                      </div>
	             </div>
	             <div class="form-row">
                      <div class="form-group col-md-8">
                           <label for="cena">Cena(rsd)</label>
                           <input type="text" class="form-control" id="cena" name="cena" aria-describedby="emailHelp" placeholder="Unesite cenu u dinarima">
                      </div>
	             </div>
	             <div class="form-row">
                      <div class="form-group col-md-8">
                           <label for="euro">Cena(&euro;)</label>
                           <input type="text" class="form-control" id="euro" name="euro" aria-describedby="emailHelp" placeholder="Unesite cenu u eurima">
                      </div>
	             </div>
	             <div class="form-row">
                      <div class="form-group col-md-8">
                           <label for="tezina">Tezina(kg)</label>
                           <input type="text" class="form-control" id="tezina" name="tezina" aria-describedby="emailHelp" placeholder="Unesite tezinu">
                      </div>
	             </div>
               <div class="form-row">
                      <div class="form-group col-md-8">
                           <label for="pozicija">Pozicija u setu</label>
                           <input type="text" class="form-control" id="pozicija" name="pozicija" aria-describedby="emailHelp" placeholder="Unesite poziciju prikaza">
                      </div>
               </div>
	             <div class="form-row">
                      <div class="form-group col-md-8">
                           <label for="kategorije">Kategorije</label>
                           <select name="ddlKategorije" id="kategorije">
                           		<option value="0">Izaberi</option>
                           		@foreach($kategorije as $kategorija)
                           			<option value="{{ $kategorija->id }}">{{ $kategorija->naziv }}</option>
                           		@endforeach
                           </select>
                      </div>
                 </div>
                 <div class="form-row">
                      <div class="form-group col-md-8">
                           <label for="popust">Popust</label>
                           <select name="ddlPopust">
                           		<option value="0">Izaberi</option>
                           		@foreach($popusti as $popust)
                           			<option value="{{ $popust->id }}">{{ $popust->popust }}</option>
                           		@endforeach
                           </select>
                      </div>
                 </div>
	             <div class="form-row">
                      <div class="form-group col-md-8">
                           <label for="slike">Slika</label>
                           <input type="file" class="form-control-file" name="slike[]" id="slike" multiple/>
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
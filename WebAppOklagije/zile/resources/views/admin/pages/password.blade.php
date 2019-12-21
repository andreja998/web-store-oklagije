@extends('admin.layout.template')

@section('content')
	@isset($korisnik)
		<div class="container">

		    <h3>{{ $korisnik->username }}</h3>

		    <p>{{ $korisnik->imePrezime }}</p>
		    <p>{{ $korisnik->email }}</p>

		    <hr/>

		    <div class="row">
		    <div class="status-upload mb-2">
	               <form method="post" action="{{ asset('/admin/resetPassword') }}">
	               	{{ csrf_field() }}
                          <div class="form-group col-md-6">
                               <label for="lozninka">Nova lozninka</label>
                               <input type="text" class="form-control" name="lozinka" id="lozinka" placeholder="Unesite lozinku" />
                               <small id="lozinka" class="form-text text-muted">Unesite lozinku</small>
                               <input type="hidden" name="korisnik" value="{{ $korisnik->id }}"/>
                          </div>
                          <div class="form-group col-md-6">
                               <button type="submit" class="float-right btn text-white btn-primary ml-2 mb-2">
	                         		<i class="fa fa-check text-white"></i> Dodeli
	                    		</button>
                          </div>
                    </form>
	          </div>
	      </div>
		</div>
	@endisset
@endsection
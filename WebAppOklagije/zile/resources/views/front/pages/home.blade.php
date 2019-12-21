@extends('front.layout.template')

@section('content')     
     @include('front.components.home.slider')
     @include('front.components.home.welcome')
     <div class="welcome container">
     	<div class="row align-items-center">
	        @if(session()->has('error'))
	            <div class="col-md-6 col-lg-12 mt-4 alert alert-danger d-flex text-center justify-content-center">
	                {{ session('error') }}
	            </div>
	        @elseif(session()->has('success'))
	        	<div class="col-md-6 col-lg-12 mt-4 alert alert-success d-flex text-center justify-content-center">
	                {{ session('success') }}
	            </div>
	        @endif

	        @if($errors->any())
	            <div class="col-md-6 col-lg-12 mt-4 d-flex text-center justify-content-center">
	                <ul class="list-group">
	                    @foreach($errors->all() as $error)
	                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
	                    @endforeach
	                </ul>
	            </div>
	        @endif
    	</div>

     	@include('front.components.home.about')
    	@include('front.components.home.feedback')
        @include('front.components.home.partners')     
     </div>
@endsection
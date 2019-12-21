@extends('front.layout.template')

@section('content')
<div class="container">
	@include('front.components.products.filter')
	<div class="proizvodi-naslov text-center mb-3">
        <div>
            <hr/>
        </div>
    </div>
    <div id="proizvodi">
		@include('front.components.products.sort')
		<div id="proizvod">
			@include('front.components.products.products')
			@include('front.components.products.pagination')
		</div>
	</div>
</div>
@endsection
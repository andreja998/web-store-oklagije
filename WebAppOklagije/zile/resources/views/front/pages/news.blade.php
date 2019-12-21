@extends('front.layout.template')

@section('content')

  @if(count($vesti) != 0)
  	@component('front.components.news.topNews', ['topVest' => $topVest])
  	@endcomponent

  	<div id="vesti" class="container mt-4">
            @foreach($vesti as $vest)
            	@if($loop->index % 2!= 0)
            		@include('front.components.news.rightNews')
            	@else
            		@include('front.components.news.leftNews')
            	@endif
            @endforeach
            
            <div class="mt-4">
          	  {{ $vesti->links() }}
        	</div>
      </div>

  @else
    <div id="vesti" class="container mt-4">
            <h3>Trenutno nema vesti na našem sajtu.</h3>
      </div>
  @endif

@endsection
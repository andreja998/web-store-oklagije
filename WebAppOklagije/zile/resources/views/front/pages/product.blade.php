@extends('front.layout.template')

@section('content')
@isset($proizvod)
<div class="container">
  @include('front.components.product.details')
  @include('front.components.product.related')
  @include('front.components.product.comment')
</div>
@endisset
@endsection
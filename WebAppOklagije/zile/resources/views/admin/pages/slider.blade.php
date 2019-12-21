@extends('admin.layout.template')

@section('content')
	<div class="table-responsive-md">
          <div class="col-md-4 mb-2">
               <a href="{{ asset('admin/newSlider') }}" class="btn btn-success btn-block">Kreiraj slajder
                    <i class="fa fa-angle-right"></i>
               </a>
          </div>
          <table class="table table-hover table-striped">
               <thead>
                    <tr>
                         <th scope="col">Naslov</th>
                         <th scope="col">Slika</th>
                         <th scope="col"></th>
                    </tr>
               </thead>
               <tbody>
                    @foreach($slajderi as $s)
                         <tr>
                              <td>@if($s->naslov != null) {{ $s->naslov }} @else Bez naslova @endif</td>
                              <td><div class="wrapper-slika"><img class="img-fluid" src="{{ asset('/'.$s->src) }}"/></div></td>
                              <td>
                                   <a href="{{ asset('admin/slider/delete/'.$s->id) }}" class="btn btn-danger btn-block">Izbrisi
                                        <i class="fa fa-trash"></i>
                                   </a>
                              </td>
                         </tr>
                    @endforeach
                    
               </tbody>
          </table>
          {{ $slajderi->links() }}
     </div>
@endsection
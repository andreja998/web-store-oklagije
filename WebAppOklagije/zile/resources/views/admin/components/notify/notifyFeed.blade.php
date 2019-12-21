@extends('admin.layout.template')

@section('content')
	<div class="table-responsive-md">
          <table class="table table-hover table-striped">
               <tbody>
                    @if(count($notifikacije) != 0)
                         @foreach($notifikacije as $n)
                              <tr>
                                   <td>Korisnik <b>{{ $n->username }}</b> je uneo novi utisak. Pogledajte vise na stranici <a href="{{ asset('/admin/feed') }}"><b>Utisci</b></a>.</td>
                                   <td>
                                        <a href="{{ asset('admin/notify/'.$n->id) }}" class="btn btn-success btn-block">Pregledao
                                             <i class="fa fa-angle-right"></i>
                                        </a>
                                   </td>
                              </tr>
                         @endforeach
                    @else
                         <tr>
                              <td>Trenutno nema notifikacija za ovu kategoriju. Idite na <a href="{{ asset('/admin/home') }}"><b>Pocetnu</b></a>.</td>
                         </tr>
                    @endif
               </tbody>
          </table>
     </div>
@endsection
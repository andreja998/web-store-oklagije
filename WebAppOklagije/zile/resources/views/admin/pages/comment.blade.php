@extends('admin.layout.template')

@section('content')
	<div class="table-responsive-md">
          <table class="table table-hover table-striped">
               <thead>
                    <tr>
                         <th scope="col">Korisnicko ime</th>
                         <th scope="col">Tekst</th>
                         <th scope="col">Datum</th>
                         <th scope="col">Proizvod</th>
                         <th scope="col"></th>
                         <th scope="col"></th>
                    </tr>
               </thead>
               <tbody>
                    @foreach($komentari as $k)
                         <tr>
                              <td>{{ $k->username }}</td>
                              <td>{{ $k->tekst }}</td>
                              <td>{{ date('d.m.Y.',$k->datum) }}</td>
                              <td>{{ $k->naziv }}</td>
                              <td>
                                   @if($k->odgovor == null)
                                   <a href="{{ asset('admin/comment/answer/'.$k->id) }}" class="btn btn-success btn-block">Odgovori
                                        <i class="fa fa-angle-right"></i>
                                   </a>
                                   @else
                                        <h5>Odgovoreno</h5>
                                   @endif
                              </td>
                              <td>
                                   <a href="{{ asset('admin/comment/delete/'.$k->id) }}" class="btn btn-danger btn-block">Izbrisi
                                        <i class="fa fa-trash"></i>
                                   </a>
                              </td>
                         </tr>
                    @endforeach
                    
               </tbody>
          </table>
          {{ $komentari->links() }}
     </div>
@endsection
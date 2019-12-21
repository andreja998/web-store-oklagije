@extends('admin.layout.template')

@section('content')
	<div class="table-responsive-md">
          <div class="col-md-4 mb-2">
               <a href="{{ asset('admin/newAction') }}" class="btn btn-success btn-block">Kreiraj popust
                    <i class="fa fa-angle-right"></i>
               </a>
          </div>
          <table class="table table-hover table-striped">
               <thead>
                    <tr>
                         <th scope="col">Popust</th>
                         <th scope="col"></th>
                         <th scope="col"></th>
                    </tr>
               </thead>
               <tbody>
                    @foreach($popusti as $p)
                         <tr>
                              <td>@if($p->popust != 0) {{ $p->popust }} % @else Bez popusta @endif</td>
                              <td>
                                   <a href="{{ asset('admin/action/add/'.$p->id) }}" class="btn btn-success btn-block">Dodaj proizvod
                                        <i class="fa fa-angle-right"></i>
                                   </a>
                              </td>
                              <td>
                                   <a href="{{ asset('admin/action/delete/'.$p->id) }}" class="btn btn-danger btn-block">Izbrisi
                                        <i class="fa fa-trash"></i>
                                   </a>
                              </td>
                         </tr>
                    @endforeach
                    
               </tbody>
          </table>
          {{ $popusti->links() }}
     </div>
@endsection
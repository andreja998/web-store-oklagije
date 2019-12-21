@extends('admin.layout.template')

@section('content')
	<div class="table-responsive-md">
          <div class="col-md-4 mb-2">
               <a href="{{ asset('admin/newProduct') }}" class="btn btn-success btn-block">Kreiraj proizvod
                    <i class="fa fa-angle-right"></i>
               </a>
          </div>
          <table class="table table-hover table-striped">
               <thead>
                    <tr>
                         <th scope="col">Naziv</th>
                         <th scope="col"></th>
                         <th scope="col"></th>
                    </tr>
               </thead>
               <tbody>
                    @foreach($proizvodi as $p)
                         <tr>
                              <td>{{ $p->kategorija.' '.$p->naziv }}</td>
                              <td>
                                   <a href="{{ asset('admin/products/view/'.$p->id) }}" class="btn btn-success btn-block">Pogledaj
                                        <i class="fa fa-angle-right"></i>
                                   </a>
                              </td>
                              <td>
                                   <a href="{{ asset('admin/products/delete/'.$p->id) }}" class="btn btn-danger btn-block">Izbrisi
                                        <i class="fa fa-trash"></i>
                                   </a>
                              </td>
                         </tr>
                    @endforeach
                    
               </tbody>
          </table>
          {{ $proizvodi->links() }}
     </div>
@endsection
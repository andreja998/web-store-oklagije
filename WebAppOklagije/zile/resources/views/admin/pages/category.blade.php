@extends('admin.layout.template')

@section('content')
	<div class="table-responsive-md">
          <div class="col-md-4 mb-2">
               <a href="{{ asset('admin/newCategory') }}" class="btn btn-success btn-block">Kreiraj kategoriju
                    <i class="fa fa-angle-right"></i>
               </a>
          </div>
          <table class="table table-hover table-striped">
               <thead>
                    <tr>
                         <th scope="col">Naziv</th>
                         <th scope="col">Namena</th>
                         <th scope="col"></th>
                    </tr>
               </thead>
               <tbody>
                    @foreach($kategorije as $k)
                         <tr>
                              <td>{{ $k->naziv }}</td>
                              <td>{{ $k->namena }}</td>
                              <td>
                                   <a href="{{ asset('admin/category/delete/'.$k->id) }}" class=" disabled btn btn-danger btn-block">Izbrisi
                                        <i class="fa fa-trash"></i>
                                   </a>
                              </td>
                         </tr>
                    @endforeach
                    
               </tbody>
          </table>
          {{ $kategorije->links() }}
     </div>
@endsection
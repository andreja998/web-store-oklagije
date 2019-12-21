@extends('admin.layout.template')

@section('content')
	<div class="table-responsive-md">
          <table class="table table-hover table-striped">
               <thead>
                    <tr>
                         <th scope="col">Ime i prezime</th>
                         <th scope="col">Email</th>
                         <th scope="col">Korisnicko ime</th>
                         <th scope="col"></th>
                    </tr>
               </thead>
               <tbody>
                    @foreach($korisnici as $k)
                         <tr>
                              <td>{{ $k->imePrezime }}</td>
                              <td>{{ $k->email }}</td>
                              <td>{{ $k->username }}</td>
                              <td>
                                   <a href="{{ asset('admin/newPassword/'.$k->id) }}" class="btn btn-success btn-block">Nova lozinka
                                        <i class="fa fa-angle-right"></i>
                                   </a>
                              </td>
                         </tr>
                    @endforeach
                    
               </tbody>
          </table>
          {{ $korisnici->links() }}
     </div>
@endsection
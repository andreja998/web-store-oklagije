@extends('admin.layout.template')

@section('content')
	<div class="table-responsive-md">
          <table class="table table-hover table-striped">
               <thead>
                    <tr>
                         <th scope="col">Ime i prezime</th>
                         <th scope="col">E-mejl</th>
                         <th scope="col">Datum</th>
                         <th scope="col">Status</th>
                         <th scope="col"></th>
                    </tr>
               </thead>
               <tbody>
                    @foreach($poruke as $p)
                         <tr>
                              <td>{{ $p->imePrezime }}</td>
                              <td>{{ $p->email }}</td>
                              <td>{{ date('d.m.Y.',$p->datum) }}</td>
                              <td>@if($p->status == 0) <b>Nova poruka</b> @else <b>Pročitano</b> @endif</td>
                              <td>
                                   <a href="{{ asset('admin/message/'.$p->id) }}" class="btn btn-success btn-block">Pročitaj
                                        <i class="fa fa-angle-right"></i>
                                   </a>
                              </td>
                         </tr>
                    @endforeach
                    
               </tbody>
          </table>
     </div>
@endsection
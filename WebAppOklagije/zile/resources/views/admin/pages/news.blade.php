@extends('admin.layout.template')

@section('content')
	<div class="table-responsive-md">
          <div class="col-md-4 mb-2">
               <a href="{{ asset('/admin/news/add') }}" class="btn btn-success btn-block">Kreiraj vest
                    <i class="fa fa-angle-right"></i>
               </a>
          </div>
          <table class="table table-hover table-striped">
               <thead>
                    <tr>
                         <th scope="col">Naslov</th>
                         <th scope="col">Top vest</th>
                         <th scope="col"></th>
                         <th scope="col"></th>
                    </tr>
               </thead>
               <tbody>
                    @foreach($news as $n)
                         <tr>
                              <td>{{ $n->naslov }}</td>
                              <td>@if($n->status == 1) <b>Top vest</b> @else <b>/</b> @endif</td>
                              <td>
                                   <a href="{{ asset('admin/news/update/'.$n->id) }}" class="btn btn-warning btn-block">Izmeni vest
                                        <i class="fa fa-angle-right"></i>
                                   </a>
                              </td>
                              <td>
                                   <a href="{{ asset('admin/news/delete/'.$n->id) }}" class="btn btn-danger btn-block">Izbrisi
                                        <i class="fa fa-trash"></i>
                                   </a>
                              </td>
                         </tr>
                    @endforeach
                    
               </tbody>
          </table>
          {{ $news->links() }}
     </div>
@endsection
@extends('admin.layout.template')

@section('content')
	<div class="table-responsive-md">
          <table class="table table-hover table-striped">
               <thead>
                    <tr>
                         <th scope="col">Korisnicko ime</th>
                         <th scope="col">Tekst</th>
                         <th scope="col">Datum</th>
                         <th scope="col">Status</th>
                         <th scope="col"></th>
                         <th scope="col"></th>
                    </tr>
               </thead>
               <tbody>
                    @foreach($utisci as $u)
                         <tr>
                              <td>{{ $u->username }}</td>
                              <td>{{ $u->tekst }}</td>
                              <td>{{ date('d.m.Y.',$u->datum) }}</td>
                              <td><input type="checkbox" id="{{ $u->id }}" name="chbStatus" {{ ($u->status) == 1 ? 'checked' : '' }} value="{{ $u->status }}" disabled /></td>
                              <td>
                                   @if($u->status == 0)
                                        <a href="{{ asset('admin/feed/update/'.$u->id) }}" class="btn btn-success btn-block">Dozvoli
                                             <i class="fa fa-angle-right"></i>
                                        </a>
                                   @else
                                        <a href="{{ asset('admin/feed/cancle/'.$u->id) }}" class="btn btn-danger btn-block">Zabrani
                                             <i class="fa fa-angle-right"></i>
                                        </a>
                                   @endif
                              </td>
                              <td>
                                   <a href="{{ asset('admin/feed/delete/'.$u->id) }}" class="btn btn-danger btn-block">Izbrisi
                                        <i class="fa fa-trash"></i>
                                   </a>
                              </td>
                         </tr>
                    @endforeach
                    
               </tbody>
          </table>
          {{ $utisci->links() }}
     </div>
@endsection
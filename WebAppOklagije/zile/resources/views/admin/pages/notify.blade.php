@extends('admin.layout.template')

@section('content')
	<div class="table-responsive-md">
          <table class="table table-hover table-striped">
               <tbody>
                    @if(count($notifikacije) != 0)
                         @foreach($notifikacije as $n)
                         	@if($n->id_vrste == 1)
                              <tr>
                                   <td>Imate novi komentar</td>
                                   <td>
                                        <a href="{{ asset('admin/notify/'.$n->id) }}" class="btn btn-success btn-block">Pregledao
                                             <i class="fa fa-angle-right"></i>
                                        </a>
                                   </td>
                              </tr>
                              @elseif($n->id_vrste == 2)
     						<tr>
                                   <td>Imate novi utisak</td>
                                   <td>
                                        <a href="{{ asset('admin/notify/'.$n->id) }}" class="btn btn-success btn-block">Pregledao
                                             <i class="fa fa-angle-right"></i>
                                        </a>
                                   </td>
                              </tr>
                              @else
                              	<tr>
                                   <td>Imate novu narudzbinu</td>
                                   <td>
                                        <a href="{{ asset('admin/notify/'.$n->id) }}" class="btn btn-success btn-block">Pregledao
                                             <i class="fa fa-angle-right"></i>
                                        </a>
                                   </td>
                              </tr>
                              @endif
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
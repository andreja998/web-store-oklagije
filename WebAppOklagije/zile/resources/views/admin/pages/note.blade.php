@extends('admin.layout.template')

@section('content')
	@if(count($beleska) != 0)
          <div class="container">

              <p>{{ $beleska[0]->tekst }}</p>

              <hr/>
              <div class="row">
               <div class="col-md-3 justify-content-end">
                        <a href="{{ asset('admin/noteDelete/'.$beleska[0]->id) }}" class="btn btn-danger btn-block">
                         Izbrisi <i class="fa fa-trash"></i>
                      </a>
                  </div>
             </div>
          </div>
     @else
          @isset($id)
               <div class="container">
                    <div class="row">
                       <div class="col-md-8 mt-4">
                         <h4>Dodaj belseku</h4>
                            <form action="{{ asset('/note/insert/'.$id) }}" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                                 <div class="form-row">
                                     <div class="form-group col-md-8">
                                          <label for="tekst">Tekst</label>
                                          <textarea class="form-control" id="tekst" name="tekst" placeholder="Unesite tekst"></textarea>
                                     </div>
                                 </div>
                                 <div class="form-row">
                                      <div class="form-group col-md-8">
                                           <button type="submit" class="float-right btn text-white btn-primary ml-2 mb-2">Unesi</button>
                                      </div>
                                 </div>
                            </form>
                       </div>
                    </div>
               </div>
          @endisset
     @endif
@endsection
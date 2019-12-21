@extends('admin.layout.template')

@section('content')
<div class="container">
     <div class="row">
          @isset($news)
        <div class="col-md-8 mt-4">
          <h4>Top vest za {{ $news->naslov }}</h4>
             <form action="{{ asset('/news/updateStatus/'.$news->id) }}" method="post" enctype="multipart/form-data">
               {{ csrf_field() }}
                  <div class="form-row">
                      <div class="form-group col-md-8">
                           <label for="top">Top vest</label>
                           <input type="checkbox" class="form-control col-md-2" id="top" aria-describedby="emailHelp" name="top" @if($news->status == 1) checked value="0" @else value="1" @endif/>
                      </div>
                  </div>
                  <div class="form-row">
                       <div class="form-group col-md-8">
                            <button type="submit" class="float-right btn text-white btn-primary ml-2 mb-2">Unesi</button>
                       </div>
                  </div>
             </form>
        </div>
        @endisset
     </div>
</div>
@endsection
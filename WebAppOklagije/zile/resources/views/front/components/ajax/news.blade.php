@foreach($vesti as $vest)
	@if($loop->index % 2!= 0)
		@include('front.components.news.rightNews')
	@else
		@include('front.components.news.leftNews')
	@endif
@endforeach

<div class="mt-4">
  {{ $vesti->links() }}
</div>

<script type="text/javascript">
  $(document).ready(function(){

  $('#vesti .page-link').click(function(e){

    e.preventDefault();

    var url = $(this).attr('href');
        var page = url.split('page=')[1];

        $.ajax({
          type: 'GET',
            url: baseURL + '/paginationNews',
            data: 
            {
                page : page
            }
        }).done(function(data){
            // console.log(data);
            $('#vesti').html(data);
        });

  });

});
</script>
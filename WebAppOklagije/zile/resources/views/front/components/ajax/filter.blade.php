@include('front.components.products.products')
@include('front.components.products.pagination')

<script type="text/javascript" src="{{ asset('/') }}js/script.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

  $('#proizvodi .page-link').click(function(e){

        e.preventDefault();

        var url = $(this).attr('href');
        var page = url.split('page=')[1];
        var category = $('.kategorija').val();
        var sort = $('#ddlSort').val();

        $.ajax({
            type: 'GET',
            url: baseURL + '/paginationFilter',
            data: 
            {
                page : page,
                category: category,
                sort : sort
            }
        }).done(function(data){
            $('#proizvod').html(data);
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#proizvodi").offset().top
            }, 1000);
        });
    });

});
</script>
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
            $('#vesti').html(data);
        });

	});

    $('#proizvodi .page-link').click(function(e){

        e.preventDefault();

        var url = $(this).attr('href');
        var page = url.split('page=')[1];
        var sort = $('#ddlSort').val();

        $.ajax({
            type: 'GET',
            url: baseURL + '/paginationProducts',
            data: 
            {
                page : page,
                sort : sort
            }
        }).done(function(data){
            $('#proizvod').html(data);
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#proizvodi").offset().top
            }, 1000);
        });
    });

    $('.filter').click(function(e){

        e.preventDefault();

        var category = $(this).attr('data-indeks');
        var sort = $('#ddlSort').val();

        $.ajax({
            type: 'GET',
            url: baseURL + '/filter',
            data: 
            {
                category : category,
                sort : sort
            }
        }).done(function(data){
            $('#proizvod').html(data);
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#proizvodi").offset().top
            }, 1000);
        });
    });

    $('.filterAll').click(function(e){

        e.preventDefault();

        var sort = $('#ddlSort').val();

        $.ajax({
            type: 'GET',
            url: baseURL + '/filterAll',
            data: 
            {
                sort : sort
            }
        }).done(function(data){
            $('#proizvod').html(data);
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#proizvodi").offset().top
            }, 1000);
        });
    });

    $('#ddlSort').change(function(e){

        e.preventDefault();
        var sort = $(this).val();

        $.ajax({
            type: 'GET',
            url: baseURL + '/sort',
            data: 
            {
                sort : sort
            }
        }).done(function(data){
            $('#proizvod').html(data);
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#proizvodi").offset().top
            }, 1000);
        });
    });

    $('.fa-star').click(function(e){

        e.preventDefault();

        var id = $(this).attr('id');
        var ocena = id.split('_')[1];
        var id_proizvoda = window.location.href.split('/')[6];
        var id_korisnika = $('#korisnik').val();

        if(id_korisnika == undefined)
        {
            $('.recenzije').html("<i>Morate se registrovati na naš sajt.</i>");
        }
        else
        {
            $.ajax({
            type: 'GET',
            url: baseURL + '/rate',
            data:
            {
                id_korisnika : id_korisnika,
                ocena : ocena,
                id_proizvoda : id_proizvoda
            },
            dataType: "json",
            }).done(function(data){
                var tekst = "";
                $.each(data, function(index,podatak){
                    tekst += "<i>Ocena je "+ Math.floor(podatak * 100) / 100 + ", hvala sto ste nas podržali.</i>";
                });

                $('.recenzije').html(tekst);
            });
        }
    });

    $('#naruci').click(function(e){

        e.preventDefault();

        var errors = [],
        conf = {
              onElementValidate : function(valid, $el, $form, errorMess) {
                if( !valid ) 
                {
                  errors.push({el: $el, error: errorMess});
                }
              }
            },
            lang = {
              
            };

            let proizvodi = JSON.parse(window.localStorage.getItem('proizvodi'));

            if((proizvodi == null) || (proizvodi['proizvodi'].length == 0))
            {
                var tekst = "<div class='alert alert-danger'>Nema proizvoda u korpi.</div>";

                $('#narucivanjePoruka').html(tekst);
                 $([document.documentElement, document.body]).animate({
                scrollTop: $("#korpa-proizvoda").offset().top
            }, 1000);
            }
            else
            {
                 if( !$('#forma-naruci').isValid(lang, conf, false) ) 
                {
                    var tekst = "";

                    $.each(errors, function(index,error){
                        tekst += "<div class='alert alert-danger'>"+ error.error +"</div>";
                    });

                    $('#narucivanjePoruka').html(tekst);
                    $([document.documentElement, document.body]).animate({
                scrollTop: $("#korpa-proizvoda").offset().top
            }, 1000);
                } 
                else 
                {
                    var ime = $('#ime').val();
                    var prezime = $('#prezime').val();
                    var imePrezime = ime + " " + prezime;
                    var ulicaBroj = $('#ulicaBroj').val();
                    var grad = $('#grad').val();
                    var posBroj = parseInt($('#posBroj').val());
                    var telefon = $('#telefon').val();
                    let proizvodi = JSON.parse(window.localStorage.getItem('proizvodi'));

                    console.log(proizvodi);

                    $.ajax({
                    type : 'get',
                    url : baseURL + '/order',
                    data:
                    {
                        imePrezime : imePrezime,
                        ulicaBroj : ulicaBroj,
                        grad : grad,
                        posBroj : posBroj,
                        telefon : telefon,
                        proizvodi: proizvodi
                    }
                    }).done(function(data){
                        $('#narucivanjePoruka').html(data);
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $("#korpa-proizvoda").offset().top
                        }, 1000);
                        $('#naruci').addClass('disabled');
                    });
                }
            }

           
    });

});
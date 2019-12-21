function waitForMsg(){
 
	$.ajax({
		type: "GET",
		url: baseURL + "/pushNot",
		 
		async: true,
		cache: false,
		timeout:600000,
		 
		success: function(data){
			if(data.brojNotifikacija != 0)
			{
				$('.notify').html(data.brojNotifikacija);
				$('.notify').addClass('notNumb');
			}

			if(data.brojKomentara != 0)
			{
				$('.comm').html(data.brojKomentara);
				$('.comm').addClass('notNumb');
			}
			
			if(data.brojUtisaka != 0)
			{
				$('.feed').html(data.brojUtisaka);
				$('.feed').addClass('notNumb');
			}
			
			if(data.brojNarudzbina != 0)
			{
				$('.order').html(data.brojNarudzbina);
				$('.order').addClass('notNumb');
			}

			if(data.brojPoruka != 0)
			{
				$('.msg').html(data.brojPoruka);
				$('.msg').addClass('notNumb');
			}
			
			setTimeout(
				waitForMsg,
				600000
			);
		}
	});
}

$(document).ready(function(){
	waitForMsg();

	$('.status').click(function(){

		let dozvoljeneNarudzbine = [];

		let trazenaTabela = $(this).parent().parent().find('.plus-prikaz').attr('data-target');
		let sviProizvodi = $(this).parent().parent().parent().find(trazenaTabela).find('tbody .red');

		for (proizvod of sviProizvodi) {
			let dozvoljenaNarudzbina = {};
			
			dozvoljenaNarudzbina['narudzbinaId'] = parseInt(proizvod.getElementsByClassName('selekt')[0].getAttribute('id'));
			dozvoljenaNarudzbina['status'] = proizvod.getElementsByClassName('selekt')[0].checked ? dozvoljenaNarudzbina['status'] = 1 : dozvoljenaNarudzbina['status'] = 0;
			dozvoljeneNarudzbine.push(dozvoljenaNarudzbina);
		}
		
		$.ajax({
			type: "GET",
			url: baseURL + "/status",
			data:{
				dozvoljeneNarudzbine : dozvoljeneNarudzbine
			},
			success: function(data){
				$('#content').html(data);
			}
		});
	});

	$('#pagination ul li a').click(function(e){

		e.preventDefault();

		var url = $(this).attr('href');
        var page = url.split('page=')[1];

        $.ajax({
        	type: 'GET',
            url: baseURL + '/paginationOrder',
            data: 
            {
                page : page
            }
        }).done(function(data){
            $('.table-responsive-md').html(data);
        });
	});
});
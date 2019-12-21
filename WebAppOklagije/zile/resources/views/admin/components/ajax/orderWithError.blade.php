<div class="container">
     <div class="alert alert-danger col-md-6">Greska pri promeni statusa pošiljke.</div>
</div>
<div class="table-responsive-md">
          <table class="table table-hover table-striped">
               <thead>
                    <tr>
                         <th scope="col"></th>
                         <th scope="col">Ime i prezime</th>
                         <th scope="col">Adresa</th>
                         <th scope="col">Broj telefona</th>
                         <th scope="col">Status</th>
                         <th scope="col">Izbrisi</th>
                    </tr>
               </thead>
               <tbody>
                    @foreach($narudzbine as $narudzbina)
                    <tr>
                         <td>
                              <a class="plus-prikaz" data-toggle="collapse" data-target=".details{{ $narudzbina->id }}" aria-expanded="false" aria-controls="detailsRow_1">
                                   <i class="fa fa-plus-square"></i>
                              </a>
                         </td>
                         <td>{{ $narudzbina->imePrezime }}</td>
                         <td>{{ $narudzbina->ulicaBroj.' '.$narudzbina->grad.' '.$narudzbina->postanskiBroj }}</td>
                         <td>{{ $narudzbina->brojTelefona }}</td>
                         <td>
                              <a href="#" class="status btn btn-success btn-block">Promeni status
                                   <i class="fa fa-angle-right"></i>
                              </a>
                         </td>
                         <td>
                              <a href="{{ asset('/admin/order/delete/'.$narudzbina->id)}} " class="btn btn-danger btn-block">Izbrisi
                                   <i class="fa fa-trash"></i>
                              </a>
                         </td>
                    </tr>
                    <tr class="collapse itemdetail details{{ $narudzbina->id }}">
                         <td colspan="100%">
                              <table class="table table-hover table-condensed">
                                   <thead>
                                        <tr>
                                             <th style="width:60%">Proizvod</th>
                                             <th style="width:8%">Količina</th>
                                             <th style="width:32%">Status</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        @foreach($narudzbina->products as $product)
                                        <tr class='red'>
                                             <td data-th='Proizvod'>
                                                  <div class='row'>
                                                       <div class='col-sm-9'>
                                                            <h4 class=''>{{ $product->kategorija.' '.$product->naziv }}</h4>
                                                       </div>
                                                  </div>
                                             </td>
                                             <td data-th='Cena' class='cena text-center'>{{ $product->kolicina }}</td>
                                             <td><input class="selekt" type="checkbox" id="{{ $product->id }}" name="chbStatus" {{ ($product->status) == 1 ? 'checked' : '' }} value="{{ $product->status }}" /></td>
                                        </tr>
                                    @endforeach
                                   </tbody>
                              </table>
                         </td>
                    </tr>
                    @endforeach
               </tbody>
          </table>
          <div id="pagination">
               {{ $narudzbine->links() }}
          </div>
     </div>

     <script type="text/javascript">
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
          
          $('.status').click(function(){

               let dozvoljeneNarudzbine = [];

               let trazenaTabela = $(this).parent().parent().find('.plus-prikaz').attr('data-target');
               let sviProizvodi = $(this).parent().parent().parent().find(trazenaTabela).find('tbody tr');

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
     </script>
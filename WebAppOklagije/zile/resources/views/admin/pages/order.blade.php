@extends('admin.layout.template')

@section('content')
	<div class="table-responsive-md">
          <table class="table table-hover table-striped">
               <thead>
                    <tr>
                         <th scope="col"></th>
                         <th scope="col">Ime i prezime</th>
                         <th scope="col">Adresa</th>
                         <th scope="col">Broj telefona</th>
                         <th scope="col">Datum</th>
                         <th scope="col">Beleska</th>
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
                         <td>{{ date('d.m.Y.',$narudzbina->datum) }}</td>
                         <td>
                              <a href="{{ asset('/admin/note/'.$narudzbina->id) }}" class="status btn btn-warning btn-block">Beleska
                                   <i class="fa fa-angle-right"></i>
                              </a>
                         </td>
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
                                             <th style="width:2%">Status</th>
                                             <th style="width:30">Cena</th>
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
                                        <td><input class="selekt" type="checkbox" id="{{ $product->id }}" name="chbStatus" {{($product->status) ==1 ? 'checked' : '' }} value="{{ $product->status }}" /></td>
                                             <td>{{ $product->cena * $product->kolicina }} rsd</td>
                                        </tr>
                                    @endforeach
                                    <tr class='red-ukupno'>
                                         <td colspan="3"><b>Ukupno:</b></td>
                                         <td><b>{{ $narudzbina->ukupno }} rsd</b></td>
                                    </tr>
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
@endsection
@extends('front.layout.template')

@section('content')
<div class="container korpa-proizvoda" id="korpa-proizvoda">
          <table id="korpa" class="table table-hover table-condensed">
               <thead>
                    <tr>
                         <th style="width:50%">Proizvod</th>
                         <th style="width:10%">Cena</th>
                         <th style="width:15%">Količina</th>
                         <th style="width:22%" class="text-center">Suma</th>
                         <th style="width:10%"></th>
                    </tr>
               </thead>
               <tbody>
                    
               </tbody>
                <tfoot>
                    <tr>
                         <td colspan="4" class="hidden-xs text-center">
                              <h4><strong>Popunite formu ispod za potvrdu kupovine.</strong></h4>
                         </td>
                         <td class="hidden-xs text-center">
                              <h5><strong>Ukupno </strong><strong class="total"></strong> </h5>
                         </td>
                    </tr>
               </tfoot>
          </table>
          <div class="row">
               <div class="col-md-12"><div id="narucivanjePoruka"></div></div>
               <div class="col-md-8 mt-4" style="margin:0 auto;">
                    <form id="forma-naruci">
                         <div class="form-row">
                              <div class="form-group col-md-6">
                                   <label for="ime">Ime</label>
                                   <input type="text" class="form-control" name="ime" id="ime" aria-describedby="emailHelp" placeholder="Unesite ime" data-validation="required" data-validation-error-msg="Unesiti ime">
                                   <small id="emailHelp" class="form-text text-muted">Unesite ime</small>
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="prezime">Prezime</label>
                                   <input type="text" class="form-control" name="prezime" id="prezime" placeholder="Unesite prezime" data-validation="required" data-validation-error-msg="Unesiti prezime">
                                   <small id="emailHelp" class="form-text text-muted">Unesite prezime</small>
                              </div>
                         </div>
                         <div class="form-row">
                              <div class="form-group col-md-6">
                                   <label for="ulicaBroj">Ulica i broj</label>
                                   <input type="text" class="form-control" name="ulicaBroj" id="ulicaBroj" placeholder="Unesite ulicu i broj" data-validation="required" data-validation-error-msg="Unesiti ulicu i broj">
                                   <small id="emailHelp" class="form-text text-muted">Unesite ulicu i broj</small>
                              </div>
                              <div class="form-group col-md-6">
                                   <label for="grad">Grad</label>
                                   <input type="text" class="form-control" name="grad" id="grad" placeholder="Unesite grad" data-validation="required" data-validation-error-msg="Unesiti grad">
                                   <small id="emailHelp" class="form-text text-muted">Unesite grad</small>
                              </div>
                         </div>

                         <div class="form-group">
                              <label for="posBroj">Poštanski broj</label>
                              <input type="number" class="form-control" name="posBroj" id="posBroj" placeholder="Unesite poštanski broj" data-validation="required" data-validation-error-msg="Unesiti poštanski broj">
                              <small id="emailHelp" class="form-text text-muted">Unesite poštanski broj</small>
                         </div>
                         <div class="form-group">
                              <label for="telefon">Broj telefona</label>
                              <input type="text" class="form-control" name="telefon" id="telefon" placeholder="Unesite broj telefona" data-validation="required"data-validation-error-msg="Unesiti broj telefona">
                              <small id="emailHelp" class="form-text text-muted">Unesite broj telefona</small>
                         </div>
                    </form>
               </div>
          </div>
          <div class="row">
               <div class="col-sm-12">
                    <table class="table table-hover">
                         <tfoot>
                              <tr>
                                   <td>
                                        <a href="{{ asset('/products') }}" class="btn btn-warning">
                                             <i class="fa fa-angle-left"></i> Nastavite</a>
                                   </td>
                                   <td colspan="2" class="hidden-xs"></td>
                                   <td class="hidden-xs text-center">
                                   </td>
                                   <td>
                                        <a href="#" id="naruci" class="btn btn-success btn-block">Kupite
                                             <i class="fa fa-angle-right"></i>
                                        </a>
                                   </td>
                              </tr>
                         </tfoot>

                    </table>
               </div>

          </div>
     </div>
@endsection
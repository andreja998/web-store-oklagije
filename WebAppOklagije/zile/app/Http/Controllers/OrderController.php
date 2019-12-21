<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Adrese;
use App\Models\Narudzbine;
use App\Models\Notifikacije;

/**
 * kontroler za narucivanje proizvoda
 */
class OrderController extends Controller
{
	private $data;
	
	public function order(Request $request)
	{
		$proizvodi = array();
		$proizvodi = $request->get('proizvodi')['proizvodi'];

		$imePrezime = $request->get('imePrezime');
		$ulicaBroj = $request->get('ulicaBroj');
		$grad = $request->get('grad');
		$posBroj = $request->get('posBroj');
		$telefon = $request->get('telefon');

		$adrese = new Adrese();
		$adrese->imePrezime = $imePrezime;
		$adrese->ulicaBroj = $ulicaBroj;
		$adrese->grad = $grad;
		$adrese->postanskiBroj = $posBroj;
		$adrese->brojTelefona = $telefon;
		$adrese->datum = time();

		try
		{
			$id_adrese = $adrese->unos();

			if(!empty($id_adrese))
			{
				foreach ($proizvodi as $proizvod) {
					$narudzbine = new Narudzbine();
					$narudzbine->id_adrese = $id_adrese;
					$narudzbine->status = 0;
					$narudzbine->kolicina = $proizvod['kolicina'];
					$narudzbine->id_proizvoda = $proizvod['id'];
					$narudzbine->cena = $proizvod['cena'];

					$narudzbine->unos();
				}

				$notifikacie = new Notifikacije();
				$notifikacie->id_vrste = 3;
				$notifikacie->status = 1;
				try
				{
					$rez = $notifikacie->unos();

					if($rez)
					{
						return "<div class='alert alert-success text-center'><b><h4>Hvala na poverenju. Vaš proizvod ce biti isporučen u roku od 3-5 radnih dana.</h4></b></div>";
					}
				}
				catch(QueryException $ex)
				{
					\Log::error('Greska pri unosu notifikacije' . $ex->getMessage());
            		return redirect()->back()->with('error', 'Vaša narudzbina je uneta ali notifikacija nije stigla administratoru.');
				}
			}
		}
		catch(QueryException $ex)
		{
			\Log::error('Greska pri snarucivanju' . $ex->getMessage());
            return redirect()->back()->with('error', 'Greska pri narucivanju, pokusajte ponovo.');
		}
	}
}
?>
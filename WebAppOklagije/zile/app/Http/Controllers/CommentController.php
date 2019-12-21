<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Komentari;
use App\Models\Notifikacije;

/**
 * Kontroler za slanje poruka korisnika
 */
class CommentController extends Controller
{
	private $data;
	private $model = null;

    public function __construct()
    {
        $this->model = new Komentari();
    }

	public function comment(Request $request)
	{
		$rules = [
            'komentar' => 'required'
        ];

        $messages = [
            "required" => 'Polje :attribute je obavezno uneti.',
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        $validator->validate();

		$proizvod = $request->get('proizvod');
		$korisnik = $request->session()->get('korisnik')[0]->id;
		$komentar = $request->get('komentar');

		$this->model->tekst = $komentar;
		$this->model->id_proizvoda = $proizvod;
		$this->model->id_korisnika = $korisnik;
		$this->model->datum = time();

		try
		{
			$rezultat = $this->model->unos();

			if ($rezultat) {

				$notifikacije = new Notifikacije();
				$notifikacije->id_korisnika = $korisnik;
				$notifikacije->id_proizvoda = $proizvod;
				$notifikacije->id_vrste = 1;
				$notifikacije->status = 1;

				try
				{
					$notRez = $notifikacije->unos();

					if ($notRez) {
						return redirect()->back();
					}
					else
					{
						return redirect()->back()->with('error', 'Obavestenje nije stiglo administratoru.');
					}	
				}
				catch(QueryException $ex)
				{
					\Log::error('Greska pri unosu notifikacije' . $ex->getMessage());
            		return redirect()->back()->with('error', 'Vaš komentar je unet ali notifikacija nije stigla administratoru.');
				}			
			}
			else
			{
				return redirect()->back()->with('error', 'Greska. Pokusajte ponovo.');
			}
		}
		catch(QueryException $ex)
		{
			\Log::error('Greska pri slanju poruke' . $ex->getMessage());
            return redirect()->back()->with('error', 'Greska pri komentarisanju, pokusajte ponovo.');
		}
	}
}
?>
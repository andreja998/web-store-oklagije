<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Utisci;
use App\Models\Notifikacije;

/**
 * kontroler za slanje utisaka korisnika
 */
class FeedbackController extends Controller
{
	private $data;
	private $model = null;

    public function __construct()
    {
        $this->model = new Utisci();
    }
	
	public function send(Request $request)
	{
		$rules = [
            'utisak' => 'required'
        ];

        $messages = [
            "required" => 'Polje :attribute je obavezno uneti.'
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        $validator->validate();

		$tekst = $request->get('utisak');
		$id_korisnika = $request->get('korisnik');

		$this->model->tekst = $tekst;
		$this->model->id_korisnika = $id_korisnika;
		$this->model->datum = time();
		$this->model->status = 0;

		try
		{
			$rezultat = $this->model->unos();

			if ($rezultat) {

				$notifikacije = new Notifikacije();
				$notifikacije->id_korisnika = $id_korisnika;
				$notifikacije->id_vrste = 2;
				$notifikacije->status = 1;

				try
				{
					$notRez = $notifikacije->unos();

					if ($notRez) 
					{
						return redirect()->back()->with('success', 'Uspesno ste nam poslali vaš utisak.');
					}
					else
					{
						return redirect()->back()->with('error', 'Obavestenje nije stiglo administratoru.');
					}
				}
				catch(QueryException $ex)
				{
					\Log::error('Greska pri unosu notifikacije' . $ex->getMessage());
            		return redirect()->back()->with('error', 'Vaš utisak je unet ali notifikacija nije stigla administratoru.');
				}
			}
			else
			{
				return redirect()->back()->with('error', 'Greska. Pokusajte ponovo.');
			}
		}
		catch(QueryException $ex)
		{
			\Log::error('Greska pri slanju utiska' . $ex->getMessage());
            return redirect()->back()->with('error', 'Greska pri slanju utiska, pokusajte ponovo.');
		}
	}
}
?>
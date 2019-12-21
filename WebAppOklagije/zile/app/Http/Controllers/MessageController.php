<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Poruke;

/**
 * Kontroler za slanje poruka korisnika
 */
class MessageController extends Controller
{
	private $data;
	private $model = null;

    public function __construct()
    {
        $this->model = new Poruke();
    }

	public function send(Request $request)
	{
		$rules = [
            'tbImePrezime' => 'required',
            'tbEmail' => 'required|email',
            'tekst' => 'required'
        ];

        $messages = [
            "required" => 'Polje :attribute je obavezno uneti.',
            "email" => 'Email nije u dobrom formatu.'
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        $validator->validate();

		$imePrezime = $request->get('tbImePrezime');
		$email = $request->get('tbEmail');
		$tekst = $request->get('tekst');

		$this->model->imePrezime = $imePrezime;
		$this->model->email = $email;
		$this->model->tekst = $tekst;
		$this->model->datum = time();
		$this->model->id_korinsika = null; //za sada neka bude null
		$this->model->id_primaoca = 2;
		$this->model->status = 0;

		try
		{
			$rezultat = $this->model->unos();

			if ($rezultat) {
				return redirect()->back()->with('success', 'Uspesno ste nam poslali poruku.');
			}
			else
			{
				return redirect()->back()->with('error', 'Greska. Pokusajte ponovo.');
			}
		}
		catch(QueryException $ex)
		{
			\Log::error('Greska pri slanju poruke' . $ex->getMessage());
            return redirect()->back()->with('error', 'Greska pri slanju poruke, pokusajte ponovo.');
		}
	}
}
?>
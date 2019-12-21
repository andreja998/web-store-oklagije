<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Korisnici;

/**
 * kontroler za registraciju i logovanje korisnika
 */
class UserController extends Controller
{
	private $data;
	private $model = null;

	public function __construct()
	{
		$this->model = new Korisnici();
	}

	public function registration(Request $request)
	{
		$rules = [
            'fullName' => 'required',
            'korisnickoIme' => 'required|unique:korisnici,username',
            'email' => 'required|email|unique:korisnici,email',
            'lozinka' => [
                'required',
                'regex:/^[a-zA-Z\d]{6,}$/'
            ]
        ];

        $messages = [
            "lozinka.regex" => 'Lozinka mora imati najmanje 6 karaktera, mala i velika slova i cifre.',
            "required" => 'Polje :attribute je obavezno uneti.',
            "unique" => 'Polje :attribute je vec zauzeto, probajte ponovo.',
            "email" => 'Email nije u dobrom formatu.'
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        $validator->validate();

        $this->model->imePrezime = $request->get('fullName');
        $this->model->username = $request->get('korisnickoIme');
        $this->model->email = $request->get('email');
        $this->model->password = md5($request->get('lozinka'));
        $this->model->id_uloga = 2;

        try
        {
            $korisnik = $this->model->unos();
            if($korisnik)
            {
                return redirect()->back()->with('success', 'Uspesno ste se registrovali.');
            }
            else
            {
                return redirect()->back()->with('error', 'Greska pri registraciji.');
            }
        }
        catch (QueryException $e)
        {
            \Log::error('Greska priregistraciji' . $e->getMessage());
            return redirect()->back()->with('error', 'Greska pri registraciji, pokusajte ponovo.');
        }

	}

	public function login(Request $request)
	{
		$rules = [
            'korisnickoIme' => 'required',
            'lozinka' => [
                'required',
                'regex:/^[a-zA-Z\d]{6,}$/'
            ]
        ];

        $messages = [
            "lozinka.regex" => 'Lozinka mora imati najmanje 6 karaktera, mala i velika slova i cifre.',
            "required" => 'Polje :attribute je obavezno uneti.'
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        $validator->validate();

        $this->model->username = $request->get('korisnickoIme');
        $this->model->password = md5($request->get('lozinka'));

       	$rezultat = $this->model->login();

       	if($rezultat)
        {
            if ($rezultat->uloga == 2)
            {
                $request->session()->push('korisnik',$rezultat);
                return redirect('/');
            }
            elseif ($rezultat->uloga == 1)
            {
                $request->session()->push('korisnik',$rezultat);
                return redirect()->route('admin');
            }
        }
        else
        {
            return redirect('/')->with('error', 'Pogrešno korisničko ime ili lozinka. Pokusajte ponovo.');
        }
	}

	public function logout(Request $request)
	{
        $request->session()->forget('korisnik');
        $request->session()->flush();
        return redirect('/');
    }
}
?>
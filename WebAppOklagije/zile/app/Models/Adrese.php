<?php 
namespace App\Models;
use Illuminate\Support\Facades\DB;

/**
 * model adrese
 */
class Adrese
{
	public $id;
	public $imePrezime;
	public $ulicaBroj;
	public $grad;
	public $postanskiBroj;
	public $brojTelefona;
	public $datum;

	public function unos()
	{
		return DB::table('adrese')
		->insertGetId([
			'imePrezime' => $this->imePrezime,
			'ulicaBroj' => $this->ulicaBroj,
			'grad' => $this->grad,
			'postanskiBroj' => $this->postanskiBroj,
			'brojTelefona' => $this->brojTelefona,
			'datum' => $this->datum
		]);
	}

	
}
?>
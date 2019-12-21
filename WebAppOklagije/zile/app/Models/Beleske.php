<?php 
namespace App\Models;
use Illuminate\Support\Facades\DB;

/**
 * model za narudzbine
 */
class Beleske
{
	public $id;
	public $tekst;
	public $id_adrese;

	public function unos()
	{
		return DB::table('beleske')
		->insert([
			'tekst' => $this->tekst,
			'id_adrese' => $this->id_adrese
		]);
	}

	public function dohvatiBelesku()
	{
		return DB::table('beleske')
		->where('id_adrese', $this->id_adrese)
		->get();
	}

	public function izbrisi()
	{
		return DB::table('beleske')
		->where('id', $this->id)
		->delete();
	}	
}
?>
<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;

/**
 * model za ocene
 */
class Ocene
{
	public $id;
	public $id_korisnika;
	public $id_proizvoda;
	public $ocena;

	public function dohvatiOcenu()
	{
		return DB::table('ocene')
		->where('id_proizvoda', $this->id_proizvoda)
		->avg('ocena');
	}

	public function unos()
	{
		return DB::table('ocene')
		->insert([
			'id_proizvoda'=> $this->id_proizvoda,
			'id_korisnika' => $this->id_korisnika,
			'ocena' => $this->ocena
		]);
	}

	public function dohvatiOcenuKorisnika()
	{
		return DB::table('ocene')
		->where([
			['id_korisnika', $this->id_korisnika],
			['id_proizvoda', $this->id_proizvoda]
		])
		->select('*')
		->get();
	}

	public function izmenaOcene()
	{
		return DB::table('ocene')
		->where([
			['id_korisnika', $this->id_korisnika],
			['id_proizvoda', $this->id_proizvoda]
		])
		->update([
			'ocena' => $this->ocena
		]);
	}
}
?>
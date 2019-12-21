<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;

/**
 * model za odgovore
 */
class Odgovori
{
	public $id;
	public $tekst;
	public $id_komentara;
	public $datum;

	public function dohvatiOdgovor()
	{
		return DB::table('odgovori')
		->join('komentari', 'odgovori.id_komentara', 'komentari')
		->select('*')
		->get();
	}

	public function unos()
	{
		return DB::table('odgovori')
		->insert([
			'tekst' => $this->tekst,
			'id_komentara' => $this->id_komentara,
			'datum' => $this->datum
		]);
	}

	public function izmeni()
	{

	}

	public function izbrisi()
	{

	}
}
?>
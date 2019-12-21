<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;

/**
 * model za komentare
 */
class Komentari
{
	public $id;
	public $tekst;
	public $id_korisnika;
	public $id_proizvoda;
	public $datum;

	public function dohvatiKomentare()
	{
		return DB::table('komentari')
		->join('korisnici', 'komentari.id_korisnika', 'korisnici.id')
		->join('proizvodi', 'komentari.id_proizvoda', 'proizvodi.id')
		->leftJoin('odgovori', 'odgovori.id_komentara', 'komentari.id')
		->select('komentari.*', 'korisnici.username', 'proizvodi.naziv', 'odgovori.tekst as odgovor')
		->orderBy('komentari.datum', 'desc')
		->paginate(10);
	}

	public function dohvatiKomentar()
	{
		return DB::table('komentari')
		->join('korisnici', 'komentari.id_korisnika', 'korisnici.id')
		->join('proizvodi', 'komentari.id_proizvoda', 'proizvodi.id')
		->where('komentari.id', $this->id)
		->select('komentari.*', 'korisnici.username', 'proizvodi.naziv')
		->first();
	}

	public function unos()
	{
		return DB::table('komentari')
		->insert([
			'tekst' => $this->tekst,
			'id_korisnika' => $this->id_korisnika,
			'id_proizvoda' => $this->id_proizvoda,
			'datum' => $this->datum
		]);
	}

	public function izmeni()
	{

	}

	public function izbrisi()
	{
		return DB::table('komentari')
		->where('id', $this->id)
		->delete();
	}
}
?>
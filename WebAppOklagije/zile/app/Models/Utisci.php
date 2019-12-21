<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;

/**
 * model za utiske
 */
class Utisci
{
	public $id;
	public $tekst;
	public $datum;
	public $status;
	public $id_korisnika;

	public function dohvatiSve()
	{
		return DB::table('utisci')
		->join('korisnici', 'utisci.id_korisnika', 'korisnici.id')
		->select('utisci.*', 'korisnici.username')
		->orderBy('utisci.datum', 'desc')
		->paginate(10);
	}

	public function dohvatiUtisak()
	{
		return DB::table('utisci')
		->join('korisnici', 'utisci.id_korisnika', 'korisnici.id')
		->select('*')
		->where('id', $this->id)
		->first();
	}

	public function unos()
	{
		return DB::table('utisci')
		->insert([
			'tekst' => $this->tekst,
			'status' => $this->status,
			'datum' => $this->datum,
			'id_korisnika' => $this->id_korisnika
		]);
	}

	public function dozvoli()
	{
		return DB::table('utisci')
		->where('id', $this->id)
		->update([
			'status' => 1
		]);
	}

	public function zabrani()
	{
		return DB::table('utisci')
		->where('id', $this->id)
		->update([
			'status' => 0
		]);
	}

	public function izbrisi()
	{
		return DB::table('utisci')
		->where('id', $this->id)
		->delete();
	}

	public function topTri()
	{
		return DB::table('utisci')
		->join('korisnici', 'utisci.id_korisnika', 'korisnici.id')
		->where('status', 1)
		->select('*')
		->orderBy('datum', 'desc')
		->limit(3)
		->get();
	}
}
?>
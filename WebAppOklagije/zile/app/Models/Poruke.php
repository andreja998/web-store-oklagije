<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;

/**
 * model za poruke
 */
class Poruke
{
	public $id;
	public $email;
	public $imePrezime;
	public $tekst;
	public $datum;
	public $id_korisnika;
	public $id_primaoca;
	public $status;

	public function dohvatiSve()
	{
		return DB::table('poruke')
		->select('*')
		->get();
	}

	public function dohvatiPoruku()
	{
		return DB::table('poruke')
		->where('id', $this->id)
		->select('*')
		->first();
	}

	public function unos()
	{
		return DB::table('poruke')
		->insert([
			'email' => $this->email,
			'imePrezime' => $this->imePrezime,
			'tekst' => $this->tekst,
			'datum' => $this->datum,
			'id_korisnika' => $this->id_korisnika,
			'id_primaoca' => $this->id_primaoca,
			'status' => $this->status
		]);
	}

	public function izmena()
	{
		return DB::table('poruke')
		->where('id', $this->id)
		->update([
			'email' => $this->email,
			'imePrezime' => $this->imePrezime,
			'tekst' => $this->tekst,
			'datum' => $this->datum,
			'id_korisnika' => $this->id_korisnika,
			'id_primaoca' => $this->id_primaoca,
			'status' => $this->status
		]);
	}

	public function izbrisi()
	{
		return DB::table('poruke')
		->where('id', $this->id)
		->delete();
	}

	public function inbox()
	{
		return DB::table('poruke')
		->where('id_korisnika', $this->id_korisnika)
		->select('*')
		->get();
	}

	public function procitano()
	{
		return DB::table('poruke')
		->where('id', $this->id)
		->update([
			'status' => 1
		]);
	}

	//za prikaz broja novih poruka
	public function dohvatiNove()
	{
		return DB::table('poruke')
		->where('status', 0)
		->count();
	}
}
?>
<?php 
namespace App\Models;
use Illuminate\Support\Facades\DB;

/**
 * model za notifikacije
 */
class Notifikacije
{
	public $id;
	public $id_korisnika;
	public $id_vrste;
	public $id_proizvoda;
	public $status;

	public function dohvatiSve()
	{
		return DB::table('notifikacije')
		->where('status', 1)
		->select('*')
		->get();
	}

	public function dohvatiNotifikaciju()
	{
		return DB::table('notifikacije')
		->where('id', $this->id)
		->select('*')
		->first();
	}

	public function pregledanaNotifikacija()
	{
		return DB::table('notifikacije')
		->where('id', $this->id)
		->update([
			'status' => 0
		]);
	}

	public function unos()
	{
		return DB::table('notifikacije')
		->insert([
			'id_korisnika' => $this->id_korisnika,
			'id_vrste' => $this->id_vrste,
			'id_proizvoda' => $this->id_proizvoda,
			'status' => $this->status
		]);
	}

	//za prikaz broja novih notifikacija
	public function dohvatiNove()
	{
		return DB::table('notifikacije')
		->where('status', 1)
		->count();
	}

	public function noviKomentari()
	{
		return DB::table('notifikacije')
		->where([
			['id_vrste', 1],
			['status', 1]
		])
		->count();
	}

	public function noviUtisci()
	{
		return DB::table('notifikacije')
		->where([
			['id_vrste', 2],
			['status', 1]
		])
		->count();
	}

	public function noveNarudzbine()
	{
		return DB::table('notifikacije')
		->where([
			['id_vrste', 3],
			['status', 1]
		])
		->count();
	}

	public function commNotify()
	{
		return DB::table('notifikacije')
		->join('korisnici', 'notifikacije.id_korisnika', 'korisnici.id')
		->join('proizvodi', 'notifikacije.id_proizvoda', 'proizvodi.id')
		->where([
			['id_vrste', 1],
			['status', 1]
		])
		->select('notifikacije.*', 'korisnici.username', 'proizvodi.naziv')
		->get();
	}

	public function feedNotify()
	{
		return DB::table('notifikacije')
		->join('korisnici', 'notifikacije.id_korisnika', 'korisnici.id')
		->where([
			['id_vrste', 2],
			['status', 1]
		])
		->select('notifikacije.*', 'korisnici.username')
		->get();
	}

	public function orderNotify()
	{
		return DB::table('notifikacije')
		->where([
			['id_vrste', 3],
			['status', 1]
		])
		->select('*')
		->get();
	}
}
?>
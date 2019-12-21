<?php 
namespace App\Models;
use Illuminate\Support\Facades\DB;

/**
 * model za narudzbine
 */
class Narudzbine
{
	public $id;
	public $id_proizvoda;
	public $id_adrese;
	public $kolicina;
	public $status;
	public $cena;

	public function dohvatiNarudzbine()
	{
		$order = DB::table('adrese')
		->select('*')
		->orderBy('datum', 'desc')
		->paginate(20);

		foreach ($order as $o) {
			$o->products = DB::table('narudzbine')
			->join('proizvodi','narudzbine.id_proizvoda','proizvodi.id')
			->join('kategorije', 'proizvodi.id_kategorije', 'kategorije.id')
			->where('id_adrese', $o->id)
			->select('narudzbine.*', 'proizvodi.naziv as naziv', 'kategorije.naziv as kategorija')
			->get();
		}

		return $order;
	}

	public function status()
	{
		return DB::table('narudzbine')
		->where('id', $this->id)
		->update([
			'status' => $this->status
		]);
	}

	public function unos()
	{
		return DB::table('narudzbine')
		->insert([
			'id_proizvoda' => $this->id_proizvoda,
			'id_adrese' => $this->id_adrese,
			'kolicina' => $this->kolicina,
			'status' => $this->status,
			'cena' => $this->cena
		]);
	}

	public function izbrisiAdresu()
	{
		return DB::table('adrese')
		->where('id', $this->id_adrese)
		->delete();
	}

	public function izbrisiNarudzbinu()
	{
		return DB::table('narudzbine')
		->where('id', $this->id)
		->delete();
	}
}
?>
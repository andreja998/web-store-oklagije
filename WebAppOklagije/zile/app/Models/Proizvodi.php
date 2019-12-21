<?php 
namespace App\Models;
use Illuminate\Support\Facades\DB;

/**
 * model za proizvode
 */
class Proizvodi
{
	public $id;
	public $naziv;
	public $opis;
	public $cena;
	public $euro;
	public $tezina;
	public $datum;
	public $id_kategorije;
	public $id_popusta;
	public $pozicija;

	public $sort;
	public $order;

	public function dohvatiProizvode()
	{
		$products = DB::table('proizvodi')
		->leftJoin('popusti','proizvodi.id_popusta','popusti.id')
		->select('proizvodi.*', 'popusti.popust')
		->orderBy($this->sort, $this->order)
		->paginate(6);

		foreach ($products as $product) {
			$product->src = DB::table('slike')
			->where([
				['id_proizvoda', $product->id],
				['glavna', 1]
			])
			->select('*')
			->get();
		}

		return $products;
	}

	public function adminProizvodi()
	{
		return DB::table('proizvodi')
		->leftJoin('popusti','proizvodi.id_popusta','popusti.id')
		->join('kategorije', 'proizvodi.id_kategorije', 'kategorije.id')
		->select('proizvodi.*', 'popusti.popust', 'kategorije.naziv as kategorija')
		->orderBy($this->sort, $this->order)
		->paginate(10);

	}

	public function dohvatiProizvod()
	{
		$product = DB::table('proizvodi')
		->leftJoin('popusti','proizvodi.id_popusta','popusti.id')
		->join('kategorije','proizvodi.id_kategorije','kategorije.id')
		->where('proizvodi.id', $this->id)
		->select('proizvodi.*', 'kategorije.naziv as kategorija', 'popusti.popust')
		->get();

		foreach ($product as $prod) {
			$prod->src = DB::table('slike')
			->where('id_proizvoda', $prod->id)
			->select('*')
			->get();
		}

		foreach ($product as $prod) {
			$prod->comments = DB::table('komentari')
			->leftJoin('odgovori', 'komentari.id', 'odgovori.id_komentara')
			->join('korisnici', 'komentari.id_korisnika', 'korisnici.id')
			->where('id_proizvoda', $prod->id)
			->select('komentari.*', 'odgovori.tekst as odgovor', 'odgovori.datum as odgDatum', 'korisnici.*')
			->orderBy('datum', 'desc')
			->get();
		}

		foreach ($product as $prod) {
			$prod->ocena = DB::table('ocene')
			->where('id_proizvoda', $prod->id)
			->avg('ocena');
		}

		return $product;
	}

	public function unos()
	{
		return DB::table('proizvodi')
		->insertGetId([
			'naziv' => $this->naziv,
			'opis' => $this->opis,
			'cena' => $this->cena,
			'euro' => $this->euro,
			'tezina' => $this->tezina,
			'datum' => $this->datum,
			'id_kategorije' => $this->id_kategorije,
			'id_popusta' => $this->id_popusta,
			'pozicija' => $this->pozicija
		]);
	}

	public function izmeni()
	{
		return DB::table('proizvodi')
		->where('id', $this->id)
		->update([
			'naziv' => $this->naziv,
			'opis' => $this->opis,
			'cena' => $this->cena,
			'euro' => $this->euro,
			'tezina' => $this->tezina,
			'pozicija' => $this->pozicija,
			'id_kategorije' => $this->id_kategorije,
			'id_popusta' => $this->id_popusta
		]);
	}

	public function izbrisi()
	{
		return DB::table('proizvodi')
		->where('id', $this->id)
		->delete();
	}

	public function filter()
	{
		$products = DB::table('proizvodi')
		->leftJoin('popusti','proizvodi.id_popusta','popusti.id')
		->where('id_kategorije', $this->id_kategorije)
		->select('proizvodi.*', 'popusti.popust')
		->orderBy($this->sort, $this->order)
		->paginate(3);

		foreach ($products as $product) {
			$product->src = DB::table('slike')
			->where([
				['id_proizvoda', $product->id],
				['glavna', 1]
			])
			->select('*')
			->get();
		}

		return $products;
	}

	public function srodniProizvodi()
	{
		$products = DB::table('proizvodi')
		->leftJoin('popusti','proizvodi.id_popusta','popusti.id')
		->where('id_kategorije', $this->id_kategorije)
		->select('proizvodi.*', 'popusti.popust')
		->orderBy('pozicija', 'asc')
		->get();

		foreach ($products as $product) {
			$product->src = DB::table('slike')
			->where([
				['id_proizvoda', $product->id],
				['glavna', 1]
			])
			->select('*')
			->get();
		}

		return $products;
	}

	public function updateAction()
	{
		return DB::table('proizvodi')
		->where('id', $this->id)
		->update([
			'id_popusta' => $this->id_popusta
		]);
	}
}
?>
<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;

/**
 * model za slajdere
 */
class Slajder
{
	public $id;
	public $src;
	public $naslov;
	public $opis;

	public function dohvatiSve()
	{
		return DB::table('slajderi')
		->select('*')
		->get();
	}

	public function dohvatiSlajdereAdmin()
	{
		return DB::table('slajderi')
		->select('*')
		->paginate(2);
	}

	public function dohvatiSlajder()
	{
		return DB::table('slajderi')
		->select('*')
		->where('id', $this->id)
		->first();
	}

	public function unos()
	{
		return DB::table('slajderi')
		->insert([
			'src' => $this->src,
			'naslov' => $this->naslov,
			'opis' => $this->opis
		]);
	}

	public function izmeni()
	{
		return DB::table('slajderi')
		->where('id', $this->id)
		->update([
			'src' => $this->src,
			'naslov' => $this->naslov,
			'opis' => $this->opis
		]);
	}

	public function izbrisi()
	{
		return DB::table('slajderi')
		->where('id', $this->id)
		->delete();
	}

	
} 
?>
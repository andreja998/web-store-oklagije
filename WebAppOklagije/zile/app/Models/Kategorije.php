<?php 
namespace App\Models;
use Illuminate\Support\Facades\DB;

/**
 * model za kategorije
 */
class Kategorije
{
	
	public $id;
	public $naziv;
	public $namena;
	public $src;

	public function dohvatiKategorije()
	{
		return DB::table('kategorije')
		->select('*')
		->get();
	}

	public function dohvatiKategorijeAdmin()
	{
		return DB::table('kategorije')
		->select('*')
		->paginate(10);
	}

	public function dohvatiKategoriju()
	{
		return DB::table('kategorije')
		->where('id', $this->id)
		->select('*')
		->first();
	}

	public function unos()
	{
		return DB::table('kategorije')
		->insert([
			'naziv' => $this->naziv,
			'namena' => $this->namena,
			'src' => $this->src
		]);
	}

	public function izmeni()
	{
		return DB::table('kategorije')
		->where('id', $this->id)
		->update([
			'naziv' => $this->naziv,
			'namena' => $this->namena,
			'src' => $this->src
		]);
	}

	public function izbrisi()
	{
		return DB::table('kategorije')
		->where('id', $this->id)
		->delete();
	}
}
?>
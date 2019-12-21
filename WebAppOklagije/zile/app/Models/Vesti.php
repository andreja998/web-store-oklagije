<?php 
namespace App\Models;
use Illuminate\Support\Facades\DB;

/**
 * model za vesti
 */
class Vesti
{
	public $id;
	public $naslov;
	public $tekst;
	public $src;
	public $status;
	public $datum;

	public function dohvatiSve()
	{
		return DB::table('vesti')
		->select('*')
		->paginate(3);
	}

	public function dohvatiVest()
	{
		return DB::table('vesti')
		->select('*')
		->where('id',$this->id)
		->first();
	}

	public function topVest()
	{
		return DB::table('vesti')
		->where('status', 1)
		->select('*')
		->limit(1)
		->get();
	}

	public function unos()
	{
		return DB::table('vesti')
		->insert([
			'naslov' => $this->naslov,
			'tekst' => $this->tekst,
			'src'=> $this->src,
			'status' => $this->status,
			'datum' => $this->datum
		]);
	}

	public function izmena()
	{
		return DB::table('vesti')
		->where('id', $this->id)
		->update([
			'status' => $this->status
		]);
	}

	public function izbrisi()
	{
		return DB::table('vesti')
		->where('id', $this->id)
		->delete();
	}
}
?>
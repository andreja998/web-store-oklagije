<?php
namespace app\Models;
use Illuminate\Support\Facades\DB;

/**
 * modelza popuste
 */
class Popusti
{
	public $id;
	public $popust;

	public function dohvatiSve()
	{
		return DB::table('popusti')
		->select('*')
		->paginate(10);
	}

	public function getAction()
	{
		return DB::table('popusti')
		->select('*')
		->get();
	}

	public function dohvatiPopust()
	{
		return DB::table('popusti')
		->rightJoin('proizvodi', 'popusti.id', 'proizvodi.id_popusta')
		->where('proizvodi.id_popusta', '<>', $this->id)
		->select('proizvodi.*')
		->get();
	}

	public function unos()
	{
		return DB::table('popusti')
		->insert([
			'popust' => $this->popust
		]);
	}

	public function izbrisi()
	{
		return DB::table('popusti')
		->where('id',$this->id)
		->delete();
	}
}
?>
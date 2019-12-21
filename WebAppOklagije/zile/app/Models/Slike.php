<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;

/**
 * model za slajdere
 */
class Slike
{
	public $id;
	public $src;
	public $alt;
	public $glavna;
	public $id_proizvoda;


	public function unos()
	{
		return DB::table('slike')
		->insert([
			'src' => $this->src,
			'alt' => $this->alt,
			'glavna' => $this->glavna,
			'id_proizvoda' => $this->id_proizvoda
		]);
	}

	
} 
?>
<?php
	namespace App\Models;
	use Illuminate\Support\Facades\DB;

	/**
	 * primer modela
	 */
	class Uloge
	{
		
		public function dohvatiUloge()
		{
			# code...
			$rezultat = DB::select("select * from uloge");
			return $rezultat;
		}
	}
?>
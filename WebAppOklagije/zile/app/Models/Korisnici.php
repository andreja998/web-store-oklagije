<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;

/**
 * model za korisnike
 */
class Korisnici
{
	public $id;
	public $imePrezime;
	public $email;
	public $username;
	public $password;
	public $id_uloga;

	public function dohvatiSve()
	{
		return DB::table('korisnici')
		->where('id_uloga', 2)
		->select('*')
		->paginate(10);
	}

	public function dohvatiKorisnika()
	{
		return DB::table('korisnici')
		->where('id', $this->id)
		->select('*')
		->first();
	}

	public function unos()
	{
		return DB::table('korisnici')
		->insert([
			'imePrezime' => $this->imePrezime,
			'email' => $this->email,
			'username' => $this->username,
			'password' => $this->password,
			'id_uloga' => $this->id_uloga
		]);
	}

	public function izmena()
	{
		return DB::table('korisnici')
		->where('id', $this->id)
		->update([
			'password' => $this->password
		]);
	}

	public function izbrisi()
	{
		return DB::table('korisnici')
		->where('id', $this->id)
		->delete();
	}

	public function login()
    {
        return DB::table('korisnici')
        ->join('uloge','korisnici.id_uloga','uloge.id')
        ->select('korisnici.*', 'uloge.id as uloga')
        ->where([
            ['username', '=' , $this->username],
            ['password', '=', $this->password]
        ])
        ->first();
    }
}
?>
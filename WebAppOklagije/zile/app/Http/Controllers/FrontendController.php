<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Uloge;
use App\Models\Slajder;
use App\Models\Utisci;
use App\Models\Vesti;
use App\Models\Poruke;
use App\Models\Kategorije;
use App\Models\Proizvodi;

/**
 * Kontroler za korisnicki deo sajta
 */
class FrontendController extends Controller
{
	private $data;

	public function __construct()
    {
        $this->data['url'] = url()->current();
    }

	public function index()
	{
		$slajder = new Slajder();
		$this->data['slajderi'] = $slajder->dohvatiSve();

		$utisci = new Utisci();
		$this->data['utisci'] = $utisci->topTri();

		return view('front.pages.home', $this->data);
	}

	public function news()
	{
		$vesti = new Vesti();
		$this->data['topVest'] = $vesti->topVest();
		$this->data['vesti'] = $vesti->dohvatiSve();

		
		return view('front.pages.news', $this->data);
	}

	public function contact()
	{
		return view('front.pages.contact', $this->data);
	}

	public function products()
	{
		$kategorije = new Kategorije();
		$this->data['kategorije'] = $kategorije->dohvatiKategorije();

		$proizvodi = new Proizvodi();
		$proizvodi->sort = 'naziv';
		$proizvodi->order = 'asc';
		$this->data['proizvodi'] = $proizvodi->dohvatiProizvode();

		// dd($this->data);

		return view('front.pages.products', $this->data);
	}

	public function product($id = null)
	{
		if ($id != null) 
		{
			$proizvodi = new Proizvodi();
			$proizvodi->id = $id;
			$this->data['proizvod'] = $proizvodi->dohvatiProizvod();

			$proizvodi->id_kategorije = $this->data['proizvod'][0]->id_kategorije;
			$this->data['proizvodi'] = $proizvodi->srodniProizvodi();
			
			return view('front.pages.product', $this->data);
		}
		else
		{
			//greska 404
		}
	}

	public function cart()
	{
		return view('front.pages.cart', $this->data);
	}
}
?>
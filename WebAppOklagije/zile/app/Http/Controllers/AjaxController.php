<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vesti;
use App\Models\Proizvodi;
use App\Models\Ocene;

/**
 * Kontroler za rad sa ajaxom
 */
class AjaxController extends Controller
{
	private $data;

	public function paginationNews(Request $request)
    {
        $page = $request->get('page');      
        $vesti = new Vesti();
        $this->data['vesti'] = $vesti->dohvatiSve();
        
        return view('front.components.ajax.news', $this->data);
    }

    public function paginationProducts(Request $request)
    {
    	$page = $request->get('page');
        $sort = $request->get('sort');

        if($sort == 'pozicija')
        {
            $sort = 'naziv';
        }

    	$proizvodi = new Proizvodi();
        $proizvodi->sort = $sort;
        $proizvodi->order = 'asc';
    	$this->data['proizvodi'] = $proizvodi->dohvatiProizvode();

    	return view('front.components.ajax.products', $this->data);
    }

    public function filter(Request $request)
    {
    	$id = $request->get('category');
        $sort = $request->get('sort');

        if($sort == 'pozicija')
        {
            $order = 'desc';
        }
        else
        {
            $order = 'asc';
        }

    	$proizvodi = new Proizvodi();
    	$proizvodi->id_kategorije = $id;      
        $proizvodi->sort = $sort;
        $proizvodi->order = $order;
    	$this->data['proizvodi'] = $proizvodi->filter();

        if (count($this->data['proizvodi']) != 0) {
            return view('front.components.ajax.filter', $this->data);
        }
        else
        {
            return "<div class='alert alert-danger text-center'><b><h4>Žao nam je. Trenutno nema podataka za izabranu kategoriju.</h4></b></div>";
        }
    }

    public function paginationFilter(Request $request)
    {
    	$page = $request->get('page');
    	$category = $request->get('category');
        $sort = $request->get('sort');

        if($sort == 'pozicija')
        {
            $order = 'desc';
        }
        else
        {
            $order = 'asc';
        }

    	$proizvodi = new Proizvodi();
    	$proizvodi->id_kategorije = $category;       
        $proizvodi->sort = $sort;
        $proizvodi->order = $order;
    	$this->data['proizvodi'] = $proizvodi->filter();

    	return view('front.components.ajax.filter', $this->data);
    }

    public function filterAll(Request $request)
    {
        $sort = $request->get('sort'); 

        if($sort == 'pozicija')
        {
            $sort = 'naziv';
        }

    	$proizvodi = new Proizvodi();        
        $proizvodi->sort = $sort;
        $proizvodi->order = 'asc';
    	$this->data['proizvodi'] = $proizvodi->dohvatiProizvode();

    	return view('front.components.ajax.products', $this->data);
    }

    public function sort(Request $request)
    {
        $sort = $request->get('sort');
        $proizvodi = new Proizvodi();        
        $proizvodi->sort = $sort;
        $proizvodi->order = 'desc';
        $this->data['proizvodi'] = $proizvodi->dohvatiProizvode();

        return view('front.components.ajax.products', $this->data);
    }

    public function rate(Request $request)
    {
        $ocena = $request->get('ocena');
        $id_proizvoda = $request->get('id_proizvoda');
        $id_korisnika = $request->get('id_korisnika');
        
        $ocene = new Ocene();
        $ocene->id_proizvoda = $id_proizvoda;
        
        $ocene->id_korisnika = $id_korisnika;

        $red = $ocene->dohvatiOcenuKorisnika();

        if(count($red) == 1)
        {
            $ocene->ocena = $ocena;
            $rez = $ocene->izmenaOcene();

            if($rez)
            {
                $ocene->id_proizvoda = $id_proizvoda;
                $this->data['ocena'] = $ocene->dohvatiOcenu();
                return response()->json($this->data);
            }

        }
        else
        {
            $ocene->ocena = $ocena;
            $rez = $ocene->unos();

            if($rez)
            {
                $ocene->id_proizvoda = $id_proizvoda;
                $this->data['ocena'] = $ocene->dohvatiOcenu();
                return response()->json($this->data);
            }
        }

        
    }
}
?>
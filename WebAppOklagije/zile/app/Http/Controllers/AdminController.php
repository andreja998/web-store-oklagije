<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poruke;
use App\Models\Notifikacije;
use App\Models\Narudzbine;
use App\Models\Utisci;
use App\Models\Komentari;
use App\Models\Odgovori;
use App\Models\Korisnici;
use App\Models\Popusti;
use App\Models\Proizvodi;
use App\Models\Vesti;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use App\Models\Kategorije;
use App\Models\Slajder;
use App\Models\Slike;
use App\Models\Beleske;

/**
 * Kontroler za administratorski deo sajta
 */
class AdminController extends Controller
{
	private $ajaxData;
	private $data;

	public function ajax(Request $request)
	{
		$poruke = new Poruke();
		$this->ajaxData['brojPoruka'] = $poruke->dohvatiNove();

		$notifikacije = new Notifikacije();
		$this->ajaxData['brojNotifikacija'] = $notifikacije->dohvatiNove();
		$this->ajaxData['brojKomentara'] = $notifikacije->noviKomentari();
		$this->ajaxData['brojUtisaka'] = $notifikacije->noviUtisci();
		$this->ajaxData['brojNarudzbina'] = $notifikacije->noveNarudzbine();

		return response()->json($this->ajaxData, 200);
	}

	public function index()
	{
		return view('admin.pages.home');
	}

	public function inbox()
	{
		$poruke = new Poruke();
		$this->data['poruke'] = $poruke->dohvatiSve();
		return view('admin.pages.inbox', $this->data);
	}

	public function message($id = null)
	{
		if($id != null)
		{
			$poruke = new Poruke();
			$poruke->id = $id;
			$this->data['poruka'] = $poruke->dohvatiPoruku();

			$rez = $poruke->procitano();

			if($rez)
			{
				return view('admin.pages.message', $this->data);
			}
			else
			{
				return view('admin.pages.message', $this->data);
			}
		}
		else
		{
			// greska 404
		}
	}

	public function deleteMessage($id = null)
	{
		if($id != null)
		{
			$poruke = new Poruke();
			$poruke->id = $id;
			$rez = $poruke->izbrisi();
			
			if($rez)
			{
				return redirect('/admin/inbox');
			}
			else
			{
				//doslo do greske
			}
		}
		else
		{
			//greska
		}
	}

	//ovo

	public function order()
	{
		$narudzbine = new Narudzbine();
		$this->data['narudzbine'] = $narudzbine->dohvatiNarudzbine();

		$ukupno = 0;

		for ($i=0; $i < count($this->data['narudzbine']->items()); $i++) { 
			foreach ($this->data['narudzbine']->items()[$i]->products as $product) {
				$ukupno += $product->kolicina * $product->cena;
			}
			$this->data['narudzbine'][$i]->ukupno = $ukupno;
			$ukupno = 0;
		}


		return view('admin.pages.order', $this->data);
	}

	public function orderDelete($id)
	{
		$narudzbine = new Narudzbine();
		$narudzbine->id_adrese = $id;
		$rez = $narudzbine->izbrisiAdresu();
		if ($rez) {
			$this->data['narudzbine'] = $narudzbine->dohvatiNarudzbine();

			$ukupno = 0;

		for ($i=0; $i < count($this->data['narudzbine']->items()); $i++) { 
			foreach ($this->data['narudzbine']->items()[$i]->products as $product) {
				$ukupno += $product->kolicina * $product->cena;
			}
			$this->data['narudzbine'][$i]->ukupno = $ukupno;
			$ukupno = 0;
		}

			return view('admin.pages.order', $this->data);
		}
	}

	public function notify($id = null)
	{
		if($id != null)
		{
			$notifikacije = new Notifikacije();
			$notifikacije->id = $id;

			$rez = $notifikacije->pregledanaNotifikacija();

			if($rez)
			{
				return redirect()->back();
			}
			else
			{
				return redirect()->back();
			}
		}
		else
		{
			$notifikacije = new Notifikacije();
			$this->data['notifikacije'] = $notifikacije->dohvatiSve();

			return view('admin.pages.notify', $this->data);
		}
	}

	public function commNoti()
	{
		$notifikacije = new Notifikacije();
		$this->data['notifikacije'] = $notifikacije->commNotify();

		return view('admin.components.notify.notifyComm', $this->data);
	}

	public function feedNoti()
	{
		$notifikacije = new Notifikacije();
		$this->data['notifikacije'] = $notifikacije->feedNotify();

		return view('admin.components.notify.notifyFeed', $this->data);
	}

	public function orderNoti()
	{
		$notifikacije = new Notifikacije();	
		$this->data['notifikacije'] = $notifikacije->orderNotify();

		return view('admin.components.notify.notifyOrder', $this->data);
	}

//ovo
	public function status(Request $request)
	{
		$niz = $request->get('dozvoljeneNarudzbine');
		$check = 0;

		foreach ($niz as $red) {
			$narudzbine = new Narudzbine();
			$narudzbine->id = $red['narudzbinaId'];
			$narudzbine->status = $red['status'];
 			
 			$narudzbine->status();
		}

		$narudzbine = new Narudzbine();
		$this->data['narudzbine'] = $narudzbine->dohvatiNarudzbine();

		$ukupno = 0;

		for ($i=0; $i < count($this->data['narudzbine']->items()); $i++) { 
			foreach ($this->data['narudzbine']->items()[$i]->products as $product) {
				$ukupno += $product->kolicina * $product->cena;
			}
			$this->data['narudzbine'][$i]->ukupno = $ukupno;
			$ukupno = 0;
		}

		return view('admin.components.ajax.order', $this->data);

	}

	public function paginationOrder(Request $request)
	{
		$page = $request->get('page');
		$narudzbine = new Narudzbine();      
        $this->data['narudzbine'] = $narudzbine->dohvatiNarudzbine();

		return view('admin.components.ajax.pagOrder', $this->data);
	}

	public function feedback()
	{
		$utisci = new Utisci();      
        $this->data['utisci'] = $utisci->dohvatiSve();

		return view('admin.pages.feedback', $this->data);
	}

	public function feedUpdate($id)
	{
		if ($id != null) 
		{
			$utisci = new Utisci();  
			$utisci->id = $id;    
		    $rez = $utisci->dozvoli();

		    if($rez)
		    {
		    	return redirect()->back();
		    }
		    else
		    {
		    	return redirect()->back()->with('error', 'Doslo je do greske.');
		    }
		    
		}
		else
		{
			// error 404
		}
	}

	public function feedCancle($id)
	{
		if ($id != null) 
		{
			$utisci = new Utisci();  
			$utisci->id = $id;    
		    $rez = $utisci->zabrani();

		    if($rez)
		    {
		    	return redirect()->back();
		    }
		    else
		    {
		    	return redirect()->back()->with('error', 'Doslo je do greske.');
		    }
		}
		else
		{
			// error 404
		}
	}

	public function feedDelete($id)
	{
		if ($id != null) 
		{
			$utisci = new Utisci();  
			$utisci->id = $id;    
		    $rez = $utisci->izbrisi();

		    if($rez)
		    {
		    	return redirect()->back();
		    }
		    else
		    {
		    	return redirect()->back()->with('error', 'Doslo je do greske.');
		    }
		}
		else
		{
			// error 404
		}
	}

	public function comment()
	{
		$komentari = new Komentari();
		$this->data['komentari'] = $komentari->dohvatiKomentare();

		return view('admin.pages.comment', $this->data);
	}

	public function answer($id)
	{
		$komentari = new Komentari();
		$komentari->id = $id;
		$this->data['komentar'] = $komentari->dohvatiKomentar();

		return view('admin.pages.answer', $this->data);
	}

	public function sendAnswer(Request $request)
	{
		$tekst = $request->get('odgovor');
		$id_komentara = $request->get('komentar');

		$odgovori = new Odgovori();
		$odgovori->tekst = $tekst;
		$odgovori->id_komentara = $id_komentara;
		$odgovori->datum = time();

		$rez = $odgovori->unos();

		if($rez)
		{
			return redirect('/admin/comment');
		}
		else
		{
			return redirect()->back()->with('error', 'Doslo je do greske');
		}

	}

	public function commentDelete($id)
	{
		if ($id != null) 
		{
			$komentari = new Komentari();  
			$komentari->id = $id;    
		    $rez = $komentari->izbrisi();

		    if($rez)
		    {
		    	return redirect()->back();
		    }
		    else
		    {
		    	return redirect()->back()->with('error', 'Doslo je do greske.');
		    }
		}
		else
		{
			// error 404
		}
	}

	public function users()
	{
		$korisnici = new Korisnici();
		$this->data['korisnici'] = $korisnici->dohvatiSve();

		return view('admin.pages.users', $this->data);
	}

	public function newPassword($id)
	{
		if ($id != null) {
			$korisnici = new Korisnici();
			$korisnici->id = $id;
			$this->data['korisnik'] = $korisnici->dohvatiKorisnika();

			return view('admin.pages.password', $this->data);
		}
		else
		{
			//error 404
		}
		
	}

	public function resetPassword(Request $request)
	{
		$lozinka = $request->get('lozinka');
		$id = $request->get('korisnik');

		$korisnici = new Korisnici();
		$korisnici->id = $id;    
		$korisnici->password = md5($lozinka);
	    $rez = $korisnici->izmena();

	    if($rez)
	    {
	    	return redirect('/admin/users');
	    }
	    else
	    {
	    	return redirect()->back()->with('error', 'Doslo je do greske.');
	    }
	}

	public function action()
	{
		$popusti = new Popusti();
		$this->data['popusti'] = $popusti->dohvatiSve();

		return view('admin.pages.action', $this->data);
	}

	public function deleteAction($id)
	{
		if ($id != null) {
			$popusti = new Popusti();
			$popusti->id = $id;    
		    $rez = $popusti->izbrisi();

		    if($rez)
		    {
		    	return redirect()->back();
		    }
		    else
		    {
		    	return redirect()->back()->with('error', 'Doslo je do greske.');
		    }
		}
		else
		{
			//error 404
		}
	}

	public function newAction()
	{
		return view('admin.pages.newAction');
	}

	public function insertAction(Request $request)
	{
		$popusti = new Popusti();
		$popusti->popust = $request->get('popust');

		$rez = $popusti->unos();

		if($rez)
		{
			return redirect('/admin/action');
		}
		else
		{
			return redirect()->back()->with('error', 'Doslo je do greske.');
		}
	}

	public function addProductsInAction($id)
	{
		if($id != null)
		{
			$popusti = new Popusti();
			$popusti->id = $id;

			$this->data['popustId'] = $id;
			$this->data['products'] = $popusti->dohvatiPopust();
			return view('admin.pages.addProducts' , $this->data);
		}
		else
		{
			//error
		}
	}

	public function addProducts(Request $request, $id)
	{
		if($id != null)
		{
			$id_popust = $id;

			foreach ($request->get('mProizvodi') as $id) {

				$proizvodi = new Proizvodi();
				$proizvodi->id = $id;
				$proizvodi->id_popusta = $id_popust;

				$proizvodi->updateAction();
			}

			return redirect('/admin/action');
		}
		else
		{
			//error 404
		}
	}

	public function adminNews()
	{
		$vesti = new Vesti();
		$this->data['news'] = $vesti->dohvatiSve();

		return view('admin.pages.news', $this->data);
	}

	public function addNews()
	{
		return view('admin.pages.addNews');
	}

	public function insertNews(Request $request)
	{
		$naslov = $request->get('naslov');
		$tekst = $request->get('tekst');
		if($request->get('top') == null)
		{
			$top = 0;
		}
		else
		{
			$top = 1;
		}

		$slika = $request->file('slika');
		$filename = $slika->getClientOriginalName();
		$src = 'slike/vesti/'.$filename;
		$newPath = public_path('slike/vesti/'.$filename);
		$imgResize = Image::make(Input::file('slika'))->resize(400, null, function($constraint){
			$constraint->aspectRatio();
		})->save($newPath);

		$vesti = new Vesti();

		$vesti->tekst = $tekst;
		$vesti->naslov = $naslov;
		$vesti->status = $top;
		$vesti->src = $src;
		$vesti->datum = time();

		$rez = $vesti->unos();

		if($rez)
		{
			return redirect('/admin/news');
		}
		else
		{
			return redirect()->back()->with('error', 'Doslo je do greske.');
		}
	}

	public function deleteNews($id)
	{
		if ($id != null) {
			$vesti = new Vesti();
			$vesti->id = $id;    
		    $rez = $vesti->izbrisi();

		    if($rez)
		    {
		    	return redirect()->back();
		    }
		    else
		    {
		    	return redirect()->back()->with('error', 'Doslo je do greske.');
		    }
		}
		else
		{
			//error 404
		}
	}

	public function topNews($id)
	{
		if ($id != null) {
			$vesti = new Vesti();
			$vesti->id = $id;    
		    $this->data['news'] = $vesti->dohvatiVest();

		   	return view('admin.pages.updateNews', $this->data);
		}
		else
		{
			//error 404
		}
	}

	public function updateStatus(Request $request, $id)
	{
		if($id != null)
		{
			if($request->get('top') == null)
			{
				$status = 0;
			}
			elseif($request->get('top') == 0)
			{
				$status = 1;
			}
			else
			{
				$status = 1;
			}

			$vesti = new Vesti();
			$vesti->id = $id;    
			$vesti->status = $status;
		    $rez = $vesti->izmena();

		    if($rez)
		    {
		    	return redirect('/admin/news');
		    }
		    else
		    {
		    	return redirect()->back()->with('error', 'Doslo je do greske.');
		    }
		}
		else
		{
			//error
		}
	}

	//kategorije

	public function category()
	{
		$kategorije = new Kategorije();

		$this->data['kategorije'] = $kategorije->dohvatiKategorijeAdmin();

		return view('admin.pages.category', $this->data);
	}

	public function newCategory()
	{
		return view('admin.pages.newCategory');
	}

	public function deleteCategory($id)
	{
		if ($id != null) {
			$kategorije = new Kategorije();
			$kategorije->id = $id;    
		    $rez = $kategorije->izbrisi();

		    if($rez)
		    {
		    	return redirect()->back();
		    }
		    else
		    {
		    	return redirect()->back()->with('error', 'Doslo je do greske.');
		    }
		}
		else
		{
			//error 404
		}
	}

	public function insertCategory(Request $request)
	{
		$naziv = $request->get('naziv');
		$namena = $request->get('namena');

		$slika = $request->file('slika');
		$filename = $slika->getClientOriginalName();
		$src = 'slike/kategorije/'.$filename;
		$newPath = public_path('slike/kategorije/'.$filename);
		$imgResize = Image::make(Input::file('slika'))->resize(400, null, function($constraint){
			$constraint->aspectRatio();
		})->save($newPath);

		$kategorije = new Kategorije();

		$kategorije->naziv = $naziv;
		$kategorije->namena = $namena;
		$kategorije->src = $src;

		$rez = $kategorije->unos();

		if($rez)
		{
			return redirect('/admin/category');
		}
		else
		{
			return redirect()->back()->with('error', 'Doslo je do greske.');
		}
	}

	//slajderi

	public function slider()
	{
		$slajder = new Slajder();

		$this->data['slajderi'] = $slajder->dohvatiSlajdereAdmin();
		return view('admin.pages.slider', $this->data);
	}

	public function deleteSlider($id)
	{
		if ($id != null) {
			$slajder = new Slajder();
			$slajder->id = $id;    
		    $rez = $slajder->izbrisi();

		    if($rez)
		    {
		    	return redirect()->back();
		    }
		    else
		    {
		    	return redirect()->back()->with('error', 'Doslo je do greske.');
		    }
		}
		else
		{
			//error 404
		}
	}

	public function newSlider()
	{
		return view('admin.pages.newSlider');
	}

	public function insertSlider(Request $request)
	{
		$naslov = $request->get('naslov');
		$opis = $request->get('opis');

		$slika = $request->file('slika');
		$filename = $slika->getClientOriginalName();
		$src = 'slike/slider/'.$filename;
		$newPath = public_path('slike/slider/'.$filename);
		$imgResize = Image::make(Input::file('slika'))->resize(400, null, function($constraint){
			$constraint->aspectRatio();
		})->save($newPath);

		$slajder = new Slajder();

		$slajder->naslov = $naslov;
		$slajder->opis = $opis;
		$slajder->src = $src;

		$rez = $slajder->unos();

		if($rez)
		{
			return redirect('/admin/slider');
		}
		else
		{
			return redirect()->back()->with('error', 'Doslo je do greske.');
		}
	}

	//proizvodi

	public function products()
	{
		$proizvodi = new Proizvodi();
		$proizvodi->order = 'asc';
		$proizvodi->sort = 'datum';
		$this->data['proizvodi'] = $proizvodi->adminProizvodi();

		return view('admin.pages.products', $this->data);
	}

	public function newProduct()
	{
		$popusti = new Popusti();
		$this->data['popusti'] = $popusti->getAction();

		$kategorije = new Kategorije();
		$this->data['kategorije'] = $kategorije->dohvatiKategorije();

		return view('admin.pages.newProduct', $this->data);
	}

	public function insertProduct(Request $request)
	{
		// uraditi na pregled stranici proizvoda, izmenu podataka(update)
		$naziv = $request->get('naziv');
		$opis = $request->get('opis');
		$cena = $request->get('cena');
		$euro = $request->get('euro');
		$tezina = $request->get('tezina');
		$id_kategorije = $request->get('ddlKategorije');
		$id_popusta = $request->get('ddlPopust');
		$pozicija = $request->get('pozicija');

		$slike = $request->file('slike');

		$proizvodi = new Proizvodi();
		$proizvodi->naziv = $naziv;
		$proizvodi->opis = $opis;
		$proizvodi->cena = $cena;
		$proizvodi->euro = $euro;
		$proizvodi->tezina = $tezina;
		$proizvodi->id_kategorije = $id_kategorije;
		$proizvodi->id_popusta = $id_popusta;
		$proizvodi->datum = time();
		$proizvodi->pozicija = $pozicija;

		$id_proizvoda = $proizvodi->unos();

		if($id_proizvoda != null)
		{
			$glavna = head($slike);
			foreach ($slike as $slika) {

				if($glavna == $slika)
				{
					$filename = $slika->getClientOriginalName();
					$filename = time().$filename;
					$src = 'slike/proizvodi/'.$filename;
					$newPath = public_path('slike/proizvodi/'.$filename);
					$imgResize = Image::make($slika->getRealPath())->resize(400, null, function($constraint){
						$constraint->aspectRatio();
					})->save($newPath);

					$slike = new Slike();
					$slike->src = $src;
					$slike->alt = $naziv;
					$slike->id_proizvoda = $id_proizvoda;
					$slike->glavna = 1;
					$slike->unos();
				}
				else
				{
					$filename = $slika->getClientOriginalName();
					$filename = time().$filename;
					$src = 'slike/proizvodi/'.$filename;
					$newPath = public_path('slike/proizvodi/'.$filename);
					$imgResize = Image::make($slika->getRealPath())->resize(400, null, function($constraint){
						$constraint->aspectRatio();
					})->save($newPath);

					$slike = new Slike();
					$slike->src = $src;
					$slike->alt = $naziv;
					$slike->id_proizvoda = $id_proizvoda;
					$slike->glavna = 0;
					$slike->unos();
				}
			}

			return redirect('/admin/products');
		}
		else
		{
			return redirect()->back()->with('error', 'Doslo je do greske.');
		}
	}

	public function deleteProduct($id)
	{
		if ($id != null) {
			$proizvodi = new Proizvodi();
			$proizvodi->id = $id;    
		    $rez = $proizvodi->izbrisi();

		    if($rez)
		    {
		    	return redirect()->back();
		    }
		    else
		    {
		    	return redirect()->back()->with('error', 'Doslo je do greske.');
		    }
		}
		else
		{
			//error 404
		}
	}

	public function view($id)
	{
		if ($id != null) {
			$proizvodi = new Proizvodi();
			$proizvodi->id = $id;    
		    $this->data['product'] = $proizvodi->dohvatiProizvod();

		    return view('admin.pages.view', $this->data);
		}
		else
		{
			//error 404
		}
	}

	public function update($id)
	{
		if ($id != null) {
			$proizvodi = new Proizvodi();
			$proizvodi->id = $id;    
		    $this->data['product'] = $proizvodi->dohvatiProizvod();

		    $popusti = new Popusti();
			$this->data['popusti'] = $popusti->getAction();

			$kategorije = new Kategorije();
			$this->data['kategorije'] = $kategorije->dohvatiKategorije();

		    return view('admin.pages.updateProduct', $this->data);
		}
		else
		{
			//error 404
		}
	}

	public function upProd(Request $request, $id)
	{
		if ($id != null) {
			$proizvodi = new Proizvodi();
			$proizvodi->id = $id;    
			$proizvodi->naziv = $request->get('naziv');
			$proizvodi->opis = $request->get('opis');
			$proizvodi->cena = $request->get('cena');
			$proizvodi->euro = $request->get('euro');
			$proizvodi->tezina = $request->get('tezina');
			$proizvodi->pozicija = $request->get('pozicija');
			$proizvodi->id_kategorije = $request->get('ddlKategorije');
			$proizvodi->id_popusta = $request->get('ddlPopust');
		    $rez = $proizvodi->izmeni();

		    if($rez)
		    {
		    	return redirect('/admin/products');
		    }
		    else
		    {
		    	return redirect()->back()->with('error', 'Doslo je do greske.');
		    }
		}
		else
		{
			//error 404
		}
	}

	//beleske
	public function note($id)
	{
		$beleske = new Beleske();
		$beleske->id_adrese = $id;

		$this->data['beleska'] = $beleske->dohvatiBelesku();
		$this->data['id'] = $id;

		return view('admin.pages.note', $this->data);
	}

	public function insertNote(Request $request, $id)
	{
		$beleske = new Beleske();
		$beleske->id_adrese = $id;
		$beleske->tekst = $request->get('tekst');

		$rez = $beleske->unos();

	    if($rez)
	    {
	    	return redirect('/admin/order');
	    }
	    else
	    {
	    	return redirect()->back()->with('error', 'Doslo je do greske.');
	    }
	}

	public function deleteNote($id)
	{
		$beleske = new Beleske();
		$beleske->id = $id;

		$rez = $beleske->izbrisi();

	    if($rez)
	    {
	    	return redirect()->back();
	    }
	    else
	    {
	    	return redirect()->back()->with('error', 'Doslo je do greske.');
	    }
	}
}
?>
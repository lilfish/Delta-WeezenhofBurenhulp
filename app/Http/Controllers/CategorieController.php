<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\categorie;
use App\homepage_artikel;

class CategorieController extends Controller
{
    //
    public function home(){
        $home_text = homepage_artikel::all();        
        return view('welcome', compact('home_text'));
    }
    
    public function store()
    {
        $categorie = new \App\categorie;
        
        $unedited_slug = request('categorie_Naam');;
        $slug = strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $unedited_slug)));

        $categorie->titel = request('categorie_Naam');
        $categorie->slug = $slug;
        $categorie->omschrijving = request('categorie_KleineOmschrijving');
        $categorie->informatie = request('categorie_GroteOmschrijving');
        
        $categorie->save();
        
        return redirect('/home/categorie')->with('aanmaak_message', 'Categorie aangemaakt.');
    }

    public function updateCat(request $request)
    {
        $unedited_slug = request('categorie_Naam');;
        $slug = strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $unedited_slug)));

        categorie::where('id', request('cat_id'))->update([
            'titel' => request('categorie_Naam'),
            'slug' => $slug,
            'omschrijving' => request('categorie_KleineOmschrijving'),
            'informatie' => request('categorie_GroteOmschrijving'),
        ]);

        return redirect('/home/categorie')->with('update_message', 'Categorie geupdate.');
    }
    
    public function delete()
    {
        $te_deleten = request('categorieDeleten');
        categorie::where('titel', $te_deleten)->delete();
        
        return redirect('/home/categorie')->with('del_message', 'Categorie gedelete.');
    }

    public function categorieen(){
        $all_categories = categorie::all();
        return view('categories', compact('all_categories'));
    }
}

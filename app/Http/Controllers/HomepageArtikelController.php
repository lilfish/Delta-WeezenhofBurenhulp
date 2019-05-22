<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\homepage_artikel;

class HomepageArtikelController extends Controller
{
    public function update()
    {
        DB::table('homepage_artikels')
            ->update(['content' => request('content')]);

        return redirect('/home/edithome');
    }

    public function index(){
        $artiekel = homepage_artikel::all();
        return view('admin/edithome', compact('artiekel'));
    }
}

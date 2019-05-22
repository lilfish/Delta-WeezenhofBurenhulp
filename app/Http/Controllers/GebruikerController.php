<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\gebruiker;

class GebruikerController extends Controller
{
    public function delete_gebruiker(request $request)
    {
        gebruiker::where('id', $request->gebruikers_id)->delete();
        return back()->with('message', 'Gebruiker gedelete.');
    }
}

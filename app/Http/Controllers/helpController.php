<?php

namespace App\Http\Controllers;

use App\help;
use Illuminate\Http\Request;

class helpController extends Controller
{   
    public function index(){
        $help = help::pluck('help_text')->first();
        return view('help', compact('help'));
    }
    public function updateHelp(Request $request)
    {
        
        if(help::first() != null){
            $new_help = help::first();
            $old_akkoord = help::pluck('akoort_text')->first();
            help::where('help_text', help::pluck('help_text')->first())->update([
                'help_text' => request('help_tekst'),
                'akoort_text' => $old_akkoord
            ]);
            // return $new_contact_gegevens;
        } else {
            $old_akkoord = help::pluck('akoort_text')->first();
            $new_help = new \App\help; 

            $new_help->help_text = request('help_tekst');
            $new_help->akoort_text = $old_akkoord;

            $new_help->save();
        }
        return redirect()->back()->with('message', 'Help pagina geupdate.');
    }
}

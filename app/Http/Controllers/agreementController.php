<?php

namespace App\Http\Controllers;

use App\help;
use Illuminate\Http\Request;

class agreementController extends Controller
{
    public function index(){
        $agreement = help::pluck('akoort_text')->first();
        return view('agreement', compact('agreement'));
    }
    public function updateAgreement(Request $request)
    {
        if(help::first() != null){
            $new_agreement = help::first();
            $old_help = help::pluck('help_text')->first();
            help::where('akoort_text', help::pluck('akoort_text')->first())->update([
                'akoort_text' => request('agreement_tekst'),
                'help_text' => $old_help
            ]);
            // return $new_contact_gegevens;
        } else {
            $old_help = help::pluck('help_text')->first();
            $new_agreement = new \App\help; 

            $new_agreement->akoort_text = request('agreement_tekst');
            $new_agreement->help_text = $old_help;

            $new_agreement->save();
        }
        return redirect()->back()->with('message', 'Help pagina geupdate.');
    }
}

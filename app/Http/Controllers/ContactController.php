<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contact;
use App\mailModel;
use Mail;
use Validator;
use App\Http\Requests\sendContactValidation;

class ContactController extends Controller
{
    public function index()
    {
        $contact = contact::first();
        return view('contact', compact('contact'));
    }
    public function store(Request $request)
    {
        if(contact::pluck('email')->first() != null){
            $new_contact_gegevens = contact::first();
            contact::where('email', contact::pluck('email')->first())->update([
                'email' => request('email'),
                'naam' => request('naam'),
                'plaats' => request('plaats'),
                'postcode_stad' => request('postcodestad'),
                'telefoon' => request('telefoon')
            ]);
            // return $new_contact_gegevens;
        } else {
            $new_contact_gegevens = new \App\contact; 

            $new_contact_gegevens->email = request('email');
            $new_contact_gegevens->naam = request('naam');
            $new_contact_gegevens->plaats = request('plaats');
            $new_contact_gegevens->postcode_stad = request('postcodestad');
            $new_contact_gegevens->telefoon = request('telefoon');

            $new_contact_gegevens->save();
        }
        return redirect()->back()->with('message', 'Contact gegevens geupdate.');
    }

    public function sendmail(sendContactValidation $request)
    {       
        $validated = $request->validated();
        
        if (request('gender') == 'man'){
            $gender = 'meneer';
        } elseif (request('gender') == 'vrouw'){
            $gender = 'mevrouw';
        }
        $mail_data = array(
            'naam' => request('voornaam'),
            'achternaam' => request('achternaam'),
            'gender' => $gender,
            'bericht' => request('content'),
            'email' => request('email')

        );

        Mail::send('mails.contact_mail', $mail_data, function($message)
        {
            $message->to(contact::pluck('email')->first(), request('Weezenhof') . " " . request('automail'))->subject('Bericht van weezenhof!');
        });
        mailModel::AddOne();
        
        return view('/info_screens/mail')->with('message', 'Contact bericht verstuurd.');
        
    }
}

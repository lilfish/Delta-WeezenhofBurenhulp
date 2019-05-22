<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\categorie;
use App\reageer;
use App\gebruiker;
use Carbon\Carbon;
use App\post_reply;
use Mail;
use Validator;
use App\mailModel;
use App\Http\Requests\storeReplyValidation;

class reageerController extends Controller
{
    public function index($hash){
        $reply_post = reageer::where('hash', $hash)->first();
        if ($reply_post == null){
            return view('/info_screens/nietgelukt')->with('message', 'Er is iets fout gegaan met de link.');
        }
        //de originele user van de post
        $original_post_user = gebruiker::where('id', $reply_post->reageer_gebruiker_id)->first();
        
        //de user die de reply maakt
        $reply_user = gebruiker::where('id', $reply_post->gebruiker_id)->first();
        
        //some variables to send with the view
        $titel = $reply_post->titel;
        $post_id = $reply_post->original_post_id;
        // return $reply_post;

        return view('posts/reageer', compact('titel', 'post_id', 'original_post_user', 'reply_user'));
    }
    public function reageer(storeReplyValidation $request)
    {
        $validated = $request->validated();
        //check if user exsist
        $user_exist = gebruiker::ExistUser($request);

        if ($user_exist == false){
            //save user
            $gebruiker = new \App\gebruiker;
            
            $gebruiker->voornaam = request('voornaam');
            $gebruiker->achternaam = request('achternaam');
            $gebruiker->gender = request('gender');
            $gebruiker->email = request('email');
            $gebruiker->telefoon = request('telefoon');

            // $gebruiker->save();
            $insertedId = $gebruiker->id;
        } else {
            $insertedId = $user_exist[0];
        }

        //save post
        $reageer = new \App\reageer; 

        $delete_hash = md5(Carbon::now().request('telefoon').request('email').request('gender'));
        $reageer->delete_hash = $delete_hash;

        $reageer->titel = request('titel');
        $reageer->content = request('content');
        $reageer->gebruiker_id = $insertedId;
    
        $hash = md5(Carbon::now().request('titel').request('voornaam').request('achternaam'));
        $reageer->hash = "N".$hash;

        $reageer->original_post_id = request('post_id');
        $reageer->reageer_gebruiker_id = request('reply_user_id');

        $reageer->datum = Carbon::now();

        $reageer->save();

        $mail_data = array(
            'hash' => "N".$hash,
            'delete_hash' => $delete_hash,
            'naam' => request('voornaam'),
            'achternaam' => request('achternaam'),
            'titel' => request('titel'),
        );

        Mail::send('mails.reageer_verificatie', $mail_data, function($message)
        {
            $message->to(request('email'), request('voornaam') . " " . request('achternaam'))->subject('Verificatie voor uw laatste reactie');
        });
        mailModel::AddOne();
        
        return view('/info_screens/mail')->with('message', 'Verificatie mail is verstuurd naar '.request('email').'.');
    }

    public function verify($hash)
    {
        $reactie = reageer::where('hash', '=', $hash)->first();
        $post_reactie = post_reply::where('hash', '=', $hash)->first();

        if ($reactie === null) {
            return view('/info_screens/nietgelukt')->with('message', 'Verificatie is niet gelukt.');
        } else {
            if($reactie->verified == 1){
                return view('/info_screens/nietgelukt')->with('message', 'Je was al geverifieerd.'); 
            }
            $reactie->verified = 1;
            $reactie->save();

            if ($post_reactie != null){
                $post_reactie->verified = 1;
                $post_reactie->save();
            }

            $original_post = post::where('id', $reactie->original_post_id)->first();
            
            $original_gebruiker = gebruiker::where('id', $reactie->gebruiker_id)->first();
            
            $reply_gebruiker = gebruiker::where('id', $reactie->reageer_gebruiker_id)->first();

            if ($original_gebruiker->gender == 'man'){
                $gender = 'meneer';
            } elseif ($original_gebruiker->gender == 'vrouw'){
                $gender = 'mevrouw';
            }

            if ($reply_gebruiker->gender == 'man'){
                $mygender = 'meneer';
            } elseif ($reply_gebruiker->gender == 'vrouw'){
                $mygender = 'mevrouw';
            }

            $mail_data = array(
                'hash' => $reactie->hash,
                'naam' => $original_gebruiker->voornaam,
                'achternaam' => $original_gebruiker->achternaam,
                'reactie' => $reactie->content,
                'reactie_titel' => $reactie->titel,
                'post_id' => $original_post->id,
                'gender' => $gender,
                'mynaam' => $reply_gebruiker->voornaam,
                'myachternaam' => $reply_gebruiker->achternaam,
                'mygender' => $mygender
            );
    
            Mail::send('mails.reageer_mail', $mail_data, function($message) use ($reply_gebruiker)
            {
                $message->to($reply_gebruiker->email, $reply_gebruiker->voornaam . " " . $reply_gebruiker->achternaam)->subject('Een reactie op uw post op de Weezenhof burenhulp website.');
            });
            mailModel::AddOne();

            return view('info_screens/gelukt')->with('message', 'Verificatie van de post is gelukt! Je bericht is verstuurd.');
        }
    }
    public function user_verify_remove($hash)
    {
        return view('/info_screens/warning', compact('hash'))->with('message', 'Weet je zeker dat je je bericht van de website wilt afhalen?')->with('link', 'verwijder_bericht');
    }
    public function user_remove(Request $request)
    {
        $reactie = reageer::where('delete_hash', $request->hash)->first();
        post_reply::where('hash', $reactie->hash)->delete();
        reageer::where('delete_hash', $request->hash)->delete();
        return view('/info_screens/gelukt')->with('message', 'Je bericht is verwijdert.');
    }
}

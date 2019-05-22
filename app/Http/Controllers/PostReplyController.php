<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\categorie;
use App\gebruiker;
use Carbon\Carbon;
use App\post_reply;
use App\mailModel;
use Mail;
use Validator;
use App\Http\Requests\storeReplyValidation;

class PostReplyController extends Controller
{
    public function reageren(Post $post)
    {
        return view('posts.react', compact('post', 'gebruiker', 'categorie', 'replies'));
    }


    public function create_reactie(storeReplyValidation $request){

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

            $gebruiker->save();
            $insertedId = $gebruiker->id;
        } else {
            $insertedId = $user_exist[0];
        }

        //save post
        $hash = md5(Carbon::now().request('titel').request('voornaam').request('achternaam'));
        
       

        $reply = new \App\post_reply; 
        $reply->titel = request('titel');
        $reply->gebruiker_id = $insertedId;
        $reply->hash = "R".$hash;
        $reply->post_id = request('post_id');
        $reply->datum = Carbon::now();

        //reageer ook opslaan
        $reageer = new \App\reageer;

        $delete_hash = md5(Carbon::now().request('categorie').request('email').request('gender'));
        $reageer->delete_hash = $delete_hash;

        $reageer->titel = request('titel');
        $reageer->content = request('content');
        $reageer->gebruiker_id = $insertedId;
        
        $gebruiker_waar_ik_op_reageer = gebruiker::where('id', post::where('id', request('post_id'))->pluck('gebruiker_id'))->pluck('id')->first();

        $reageer->reageer_gebruiker_id = $gebruiker_waar_ik_op_reageer;;
        $reageer->hash = "R".$hash;

        $reageer->original_post_id = request('post_id');
        $reageer->datum = Carbon::now();

        $reply->save();
        $reageer->save();

        $mail_data = array(
            'hash' => "R".$hash,
            'delete_hash' => $delete_hash,
            'naam' => request('voornaam'),
            'achternaam' => request('achternaam'),
            'post_titel' => request('titel')

        );

        Mail::send('mails.reply_verificatie', $mail_data, function($message)
        {
            $message->to(request('email'), request('voornaam') . " " . request('achternaam'))->subject('Verificatie voor uw laatste reactie');
        });
        mailModel::AddOne();

        return view('/info_screens/mail')->with('message', 'Verificatie mail is verstuurd naar '.request('email').'.');

    }

    public function deleteWithId(Request $request)
    {   
        $delete_id =  $request->id;
        $post_reply = post_reply::where('id', $delete_id)->first();
        post_reply::where('id', $post_reply->id)->delete();
        return redirect('/posts/'.$post_reply->post_id);
    }
}

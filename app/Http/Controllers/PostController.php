<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use App\Post;
use App\categorie;
use App\gebruiker;
use Carbon\Carbon;
use App\post_reply;
use App\mailModel;
use File;
use Mail;
use Validator;
use App\Http\Requests\storePostValidation;

class PostController extends Controller
{

    public function posts($category){
        $category_id = categorie::GetCategorieId($category);
        if ($category_id != false){
            $getPosts = Post::where('verified', 1)->where('afgehandeld',0)->orderBy('datum', 'DESC')->where('category_id', $category_id)->join('gebruikers', 'gebruikers.id' , '=', 'posts.gebruiker_id')->select('posts.*')->paginate(15);
            if ($getPosts != false){
                
                $getOmschrijving = categorie::getOmschrijving($category);
                $getInformatie = categorie::getInformatie($category);

                $category = $category;
                return view('posts.posts', compact('getPosts', 'getOmschrijving', 'getInformatie', 'category'));
            } else {
                abort(404,'Page not found');
            }
        } else {
            abort(404,'Page not found');
        }
    }

    public function create()
    {
        return view('posts.create');
    }


    public function store(storePostValidation $request)
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

            $gebruiker->save();
            $insertedId = $gebruiker->id;
        } else {
            $insertedId = $user_exist[0];
        }

        //save post
        $post = new \App\Post; 

        $post->titel = request('titel');
        $post->content = request('content');
        $post->gebruiker_id = $insertedId;
        
        //make folder
        $random_input = request('titel') . request('datum');
        $random_string = md5($random_input);
        $dirname = request('titel') . "_" . $random_string;

        $dirname = strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $dirname)));

        $fullpathname = "../public/posts/$dirname";
        
        //create new folder, if folder already exist add Version++ to it.
        $original_name = $fullpathname;
        $version = 0;
        while (File::exists($fullpathname)){
            $version++;
            $fullpathname = $original_name . "_V".$version;
        }
        $result = File::makeDirectory($fullpathname, 0777, true);       
        //return "yes";
        
        //save images
        if($request->image){
            foreach ($request->image as $file) {
                $realname = $file->getClientOriginalName();
                $file->move($fullpathname, $realname);
            }     
        }

        $post->directory = str_replace('../public/','', $fullpathname);

        $hash = md5(Carbon::now().request('titel').request('voornaam').request('achternaam'));
        $delete_hash = md5(Carbon::now().request('categorie').request('email').request('gender'));
        $afhandel_hash = md5(Carbon::now().request('telefoon').request('titel').request('voornaam'));

        
        $post->hash = "P".$hash;
        $post->delete_hash = $delete_hash;
        $post->afhandel_hash = $afhandel_hash;
        $post->verified = "0";
        $post->category_id = request('categorie');
        $post->afgehandeld = "0";
        $post->datum = Carbon::now();

        $post->save();

        $mail_data = array(
            'hash' => "P".$hash,
            'delete_hash' => $delete_hash,
            'afhandel_hash' => $afhandel_hash,
            'naam' => request('voornaam'),
            'achternaam' => request('achternaam'),
            'post_titel' => request('titel')

        );

        Mail::send('mails.verificatie', $mail_data, function($message)
        {
            $message->to(request('email'), request('voornaam') . " " . request('achternaam'))->subject('Verificatie voor uw laatste post');
        });
        mailModel::AddOne();
        
        return view('/info_screens/mail')->with('message', 'Verificatie mail is verstuurd naar '.request('email').'.');

    }

    public function showPost(Post $post){
        $gebruiker = gebruiker::GetGebruiker($post->gebruiker_id);
        $categorie = categorie::CategorieName($post->category_id);
        $replies = post_reply::getReplies($post->id)->where('verified', 1);
        return view('posts.showPost', compact('post', 'gebruiker', 'categorie', 'replies'));
    }

    public function verify($hash)
    {
        $post = Post::where('hash', '=', $hash)->first();
        if ($post === null) {
            return view('/info_screens/nietgelukt')->with('message', 'Verificatie is niet gelukt.');
        } else {
            $post->verified = '1';
            $post->save();
            return view('/info_screens/gelukt')->with('message', 'Verificatie van de post is gelukt! Je bericht staat online.');
        }
    }

    public function deleteWithId(Request $request)
    {   
        $delete_id =  $request->id;
        $category_id = Post::where('id', $delete_id)->pluck('category_id');
        $categorie = categorie::CategorieName($category_id);
        //delete folder
        $post = Post::where('id', $delete_id)->first();
        File::deleteDirectory(public_path($post->directory));

        Post::where('id', $delete_id)->delete();
        return redirect($categorie->titel);
    }

    public function user_verify_afhandellen($hash)
    {
        return view('/info_screens/warning', compact('hash'))->with('message', 'Weet je zeker dat je je bericht wilt markeren as "afgehandeld"')->with('link', 'bericht_afhandelen');
    }
    public function user_afhandellen(Request $request)
    {
        $post = Post::where('afhandel_hash', $request->hash)->first();
        $post->afgehandeld = true;
        $post->save();
        return view('/info_screens/gelukt')->with('message', 'Je bericht is gemarkeerd als "afgehandeld".');
    }

    // Verwijder door user
    public function user_verify_remove($hash)
    {
        return view('/info_screens/warning', compact('hash'))->with('message', 'Weet je zeker dat je je bericht van de website wilt afhalen?')->with('link', 'verwijder_post');
    }
    public function user_remove(Request $request)
    {
        $post = Post::where('delete_hash', $request->hash)->first();
        File::deleteDirectory(public_path($post->directory));
        Post::where('delete_hash', $request->hash)->delete();
        return view('/info_screens/gelukt')->with('message', 'Je bericht is verwijdert.');
    }

    // Some more admin stuff
    public function admin_verify_post(Request $request){
        $post = Post::where('id', $request->id)->first();
        if($post->verified)
        {
            $post->verified = false;
            $post->save();
            return back()->with('message', 'Bericht verificatie weggehaald.');
        }
        else
        {
            $post->verified = true;
            $post->save();
            return back()->with('message', 'Bericht geverifieerd.');
        }
        
    }
    public function admin_handelaf_post(Request $request){
        $post = Post::where('id', $request->id)->first();
        if($post->afgehandeld)
        {
            $post->afgehandeld = false;
            $post->save();
            return back()->with('message', 'Bericht als "niet afgehandeld" gemarkeerd.');
        }
        else
        {
            $post->afgehandeld = true;
            $post->save();
            return back()->with('message', 'Bericht als "afgehandeld" gemarkeerd.');
        }
    }
    public function admin_delete_post(Request $request){
        $post = Post::where('id', $request->id)->first();
        File::deleteDirectory(public_path($post->directory));
        Post::where('id', $request->id)->delete();
        return back()->with('message', 'Bericht verwijderd.');
    }
    
}

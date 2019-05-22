<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\gebruiker;
use App\contact;
use App\help;
use App\mailModel;
use Carbon\Carbon;
use App\reageer;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/dashboard');
    }
    public function categorie()
    {
        return view('admin/categorie');
    }
    public function contact()
    {
        $contact = contact::first();
        return view('admin/contact', compact('contact'));
    }
    public function edithome()
    {
        return view('admin/edithome');
    }
    public function help()
    {
        $help = help::pluck('help_text')->first();
        return view('admin/help', compact('help'));
    }
    public function agreement()
    {
        $help = help::pluck('akoort_text')->first();
        return view('admin/agreement', compact('help'));
    }
    public function posts()
    {
        $posts = Post::paginate(50);
        return view('admin/posts', compact('posts'));
    }
    public function mail()
    {
        $aantal_mails = mailModel::getToday();
        $date_now = Carbon::today()->toDateString();
        $procent = 100/1000*$aantal_mails;
        $all_mails = reageer::GetAllMails();
        // return $all_mails;
        return view('admin/mail', compact('aantal_mails', 'date_now', 'procent', 'all_mails'));
    }
    public function gebruikers()
    {
        $gebruikers = gebruiker::paginate(60);
        return view('admin/gebruikers', compact('gebruikers'));
    }

    public function add_carousel(Request $request)
    {   
        
        $data = $request->image;
        $name = $request->name;
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $image_name= $name.'.png';
        $path = public_path() . "/carousel/" . $image_name;
        file_put_contents($path, $data);
        return response()->json(['success'=>'done']);
    }

    public function del_carousel(Request $request) {
        
            $deletecounter = count(request('delete'));
            for ($y = 0; $y < $deletecounter; $y++) {
                unlink(public_path(request('delete')[$y]));
            }
            return redirect('/home/edithome');
    }

    public function delete_mail(Request $request){
        reageer::where('id', $request->id)->delete();
        return back()->with('message', 'Mail gedelete.');
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class moderatorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $moderators = User::all();
        return view('admin/moderators', compact('moderators'));
    }

    public function update(){
        User::where('id', request('id'))
        ->update(['level' => request('level')]);
        return redirect('/home/moderator');
    }

    public function delete(){
        $te_deleten = request('id');
        User::where('id', $te_deleten) ->delete(); 
        return redirect('/home/moderator');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gebruiker extends Model
{
    //
    public $timestamps = false;

    public function scopeGetGebruiker($query, $gebruiker){
        return static::where('id', $gebruiker)->first();
    }

    public function scopeExistUser($query, $request){
        if (static::where([
                ['voornaam', '=', $request->input('voornaam')],
                ['achternaam', '=', $request->input('achternaam')],
                ['gender', '=', $request->input('gender')],
                ['email', '=', $request->input('email')],
                ['telefoon', '=', $request->input('telefoon')]
            ])->count() > 0) {
            return static::where([
                ['voornaam', '=', $request->input('voornaam')],
                ['achternaam', '=', $request->input('achternaam')],
                ['gender', '=', $request->input('gender')],
                ['email', '=', $request->input('email')],
                ['telefoon', '=', $request->input('telefoon')]
            ])->get()->pluck('id');
        } else {
            return false;
        }
    }
    
}

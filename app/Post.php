<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public $timestamps = false;
    
    public function scopeVerified(){
        return static::where('verified', 1)->get();
    }
    public function scopeAll(){
        return static::all()->get();
    }
    
    public function scopeWithGebruiker($query, $category_id){
            return static::where('category_id', $category_id)->join('gebruikers', 'gebruikers.id' , '=', 'posts.gebruiker_id')->get();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post_reply extends Model
{
    public $timestamps = false;
    //
    public function scopegetReplies($query, $postID){
        return static::where('post_id', $postID)->select(
                'post_replies.*', 
                'gebruikers.voornaam', 
                'gebruikers.achternaam', 
                'gebruikers.gender', 
                'gebruikers.email', 
                'gebruikers.telefoon', 
                'gebruikers.id AS gebruikers_id'
            )->leftJoin(
                'gebruikers', 
                'gebruikers.id' , 
                '=', 
                'post_replies.gebruiker_id'
            )->get();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reageer extends Model
{
    public $timestamps = false;
    protected $table = 'reageer';

    public function scopeGetAllMails($query){
        return static::select(
            'reageer.*', 
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
            'reageer.gebruiker_id'
        )->paginate(10);
    }
}

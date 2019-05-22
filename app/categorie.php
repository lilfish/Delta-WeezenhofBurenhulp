<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categorie extends Model
{
    public $timestamps = false;
        
    public function scopeAll(){
    	return static::all()->get();
    }
    public function scopeCategorieName($query, $categorie_id){
        return static::where('id', $categorie_id)->first();
    }
    public function scopeGetOmschrijving($query, $getOmschrijving){
        return static::where('slug', $getOmschrijving)->get()->pluck('omschrijving');
    }
    public function scopegetInformatie($query, $getInformatie){
        return static::where('slug', $getInformatie)->get()->pluck('informatie');
    }
    public function scopeGetCategorieId($query, $categorie){
        if (categorie::where('slug', $categorie)->exists()) {
            return static::where('slug', $categorie)->get()->pluck('id')->first();
        } else {
            return false;
        }
    }
}

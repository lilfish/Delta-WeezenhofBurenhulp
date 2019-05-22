<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class mailModel extends Model
{   
    protected $table = 'mails';
    public $timestamps = false;
    
    public function scopeAddOne($query)
    {
        
        $date_now = Carbon::today();
        $mail_size = static::where('created_at', $date_now)->first();
        if ($mail_size == null){
            static::insert(['aantal' => 1, 'created_at' => $date_now]);
        } else {
            $mail_size->aantal = $mail_size->aantal + 1;
            $mail_size->updated_at = Carbon::now();
            $mail_size->save();
        }
        return true;
    }
    
    public function scopeGetToday($query)
    {
        $date_now = Carbon::today();
        $mails = static::where('created_at', $date_now)->pluck('aantal')->first();
        if($mails == null){
            $mails = 0;
        }
        return $mails;
    }
}

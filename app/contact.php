<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'my_email';
}
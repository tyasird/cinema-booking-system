<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function showtime(){
        return $this->hasOne('App\Showtime');
    }

}

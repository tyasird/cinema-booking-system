<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function showtime(){
        return $this->belongsTo('App\Showtime');
    }

    public function movie(){
        return $this->belongsTo('App\Movie', 'showtime_id');

    }
}

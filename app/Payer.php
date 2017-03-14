<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payer extends Model
{

    protected $fillable = array('name','status');

    public function profile() {
        return $this->belongsToMany('App\Profile');
    }

}

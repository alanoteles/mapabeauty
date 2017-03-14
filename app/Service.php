<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $fillable = array('description','price', 'status');

    public function profile() {
        return $this->belongsToMany('App\Profile');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

    protected $fillable = array('filename','subtitle', 'size', 'status', 'logo');

    public function profile() {
        return $this->hasOne('App\Profile');
    }
}

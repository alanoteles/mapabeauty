<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{

    protected $fillable = array('description','filename', 'message', 'button_label', 'status');


}

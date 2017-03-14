<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
     * Para preenchimento em lote, array com os campos
     * @var array
     */
    protected $fillable = ['id','name','code','country_id'];

    public function country()
    {
        return $this->belongsTo('\App\Country');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = array('user_id', 'product_id', 'transaction_id', 'transaction_date', 'payer_id', 'detached', 'courtesy', 'status_id');


    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function status()
    {
        return $this->belongsTo('App\PurchaseStatus');
    }
}

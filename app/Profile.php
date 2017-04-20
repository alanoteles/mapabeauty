<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = array('user_id',
                                'professional_type',
                                'professional_name',
                                'fantasy_name',
                                'document',
                                'responsible_name',
                                'responsible_email',
                                'responsible_cellphone',
                                'zip_code',
                                'state',
                                'city',
                                'neighborhood',
                                'address',
                                'number',
                                'complement',
                                'latitude',
                                'longitude',
                                'about',
                                'facebook',
                                'twitter',
                                'instagram',
                                'google_plus',
                                'whatsapp',
                                'logo',
                                'status');


    public function galleries()
    {
        return $this->belongsToMany('App\Gallery');
        // return $this->hasMany('App\Gallery');
    }


    public function services()
    {
        //return $this->hasMany('App\Service');
        return $this->belongsToMany('App\Service')->withPivot('price');;
    }


    public function payers()
    {
        return $this->hasMany('App\Payer')
            ->withPivot('transaction_id','value','payment_type', 'payment_date', 'status', 'created_at', 'updated_at');
    }


    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


    public function cities()
    {
        return $this->belongsTo('App\City', 'city');
    }

}

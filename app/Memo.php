<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
     protected $table = 'memo';
     protected $fillable = [
        'user_id',
        'nomor', 
        'tanggal_memo',
        'tanggal_terima'
    ];

    public function barang(){
        return $this->hasMany('App\Barang');
    }

    // public function pr()
    // {
    //     return $this->hasOne('App\Pr');
    // }

    // public function user()
    // {
    //     return $this->belongsTo('App\User','user_id');
    // }
}

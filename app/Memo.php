<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
     protected $table = 'memo';
     protected $fillable = [
        'user_id',
        'no_memo', 
        'scan_memo',
        'spesifikasi',
        'tanggal_memo',
        'status'
    ];

    public function pr()
    {
        return $this->hasOne('App\Pr');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}

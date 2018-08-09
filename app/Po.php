<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Po extends Model
{
     protected $table = 'po';
     protected $fillable = [
		'barang_id',     	
        'nomor', 
        'tanggal_ttd_manager',
        'tanggal_ttd_dirops'
    ];

 //    public function spb()
 //    {
 //        return $this->hasOne('App\Spb');
 //    }

    public function barang()
	{
	    return $this->belongsTo('App\Barang', 'barang_id');
	}
}

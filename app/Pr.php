<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pr extends Model
{
     protected $table = 'pr';
     protected $fillable = [
        'barang_id',
        'nomor', 
        'tanggal_ttd_manager',
        'tanggal_ttd_dirops'
    ];

 //    public function po()
 //    {
 //        return $this->hasOne('App\Po');
 //    }

    public function barang()
	{
	    return $this->belongsTo('App\Barang','barang_id');
	}
}

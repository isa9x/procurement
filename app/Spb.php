<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spb extends Model
{
     protected $table = 'spb';
     protected $fillable = [
     	'po_id',
        'no_spb', 
        'scan_spb',
        'tanggal_spb'
    ];

    public function po()
	{
	    return $this->belongsTo('App\Po', 'po_id');
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Po extends Model
{
     protected $table = 'po';
     protected $fillable = [
     	'pr_id',
        'no_po', 
        'scan_po',
        'tanggal_po'
    ];

    public function spb()
    {
        return $this->hasOne('App\Spb');
    }

    public function pr()
	{
	    return $this->belongsTo('App\Pr', 'pr_id');
	}
}

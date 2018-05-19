<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pr extends Model
{
     protected $table = 'pr';
     protected $fillable = [
        'memo_id',
        'no_pr', 
        'scan_pr',
        'tanggal_pr'
    ];

    public function po()
    {
        return $this->hasOne('App\Po');
    }

    public function memo()
	{
	    return $this->belongsTo('App\Memo','memo_id');
	}
}

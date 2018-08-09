<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
   	 protected $table = 'barang';
     protected $fillable = [
        'memo_id',
        'nama', 
        'spesifikasi',
        'jumlah',
        'satuan',
        'keterangan',
        'status_pi',
        'status'
    ];

    public function memo(){
        return $this->belongsTo('App\Memo','memo_id');
    }

    public function pr(){
        return $this->hasOne('App\Pr');
    }
    
    public function po(){
        return $this->hasOne('App\Po');
    }    
}

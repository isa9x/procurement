<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
     protected $table = 'Bagian';
     protected $fillable = [
        'nama'
    ];
}

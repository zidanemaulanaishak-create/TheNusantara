<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    protected $table = 'tb_tentang';
    public $timestamps = false;
    protected $guarded = ['id'];
}

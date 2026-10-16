<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    protected $table = 'tb_pengunjung';
    public $timestamps = false;
    protected $guarded = ['id'];
}

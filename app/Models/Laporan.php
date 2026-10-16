<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'tb_laporan';
    public $timestamps = false;
    protected $guarded = ['id'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'tb_galeri';
    public $timestamps = false;
    protected $guarded = ['id'];
}

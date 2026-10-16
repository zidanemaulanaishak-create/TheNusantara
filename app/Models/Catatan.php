<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catatan extends Model
{
    protected $table = 'tb_catatan';
    public $timestamps = false;
    protected $guarded = ['id'];
}

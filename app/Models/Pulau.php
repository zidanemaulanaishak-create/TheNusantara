<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pulau extends Model
{
    protected $table = 'tb_pulau';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function informasi()
    {
        return $this->hasMany(Informasi::class, 'pulau_id');
    }
}

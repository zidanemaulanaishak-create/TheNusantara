<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    protected $table = 'tb_informasi';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function pulau()
    {
        return $this->belongsTo(Pulau::class, 'pulau_id');
    }
}

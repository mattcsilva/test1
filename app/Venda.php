<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = ['id', 'valor'];

    public function vendedor()
    {
        return $this->belongsTo('App\Vendedor', 'vendedor_id');
    }
}

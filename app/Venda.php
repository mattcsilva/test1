<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = ['id', 'valor', 'vendedor_id'];

    public function vendedor()
    {
        return $this->belongsTo('App\Vendedor', 'vendedor_id');
    }

    public function getComissao()
    {
        return 8.5;
    }
}

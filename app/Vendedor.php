<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $fillable = ['id', 'nome', 'email'];

    public function vendas()
    {
        return $this->hasMany('App\Venda');
    }
}

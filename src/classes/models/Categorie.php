<?php

namespace Application\models;

use Illuminate\Database\Eloquent as Eloquent;

class Categorie extends Eloquent\Model
{
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;


    function produits()
    {
        return $this->hasMany('Produit', 'categorie');
    }
}
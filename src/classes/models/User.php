<?php

namespace Application\models;
use Illuminate\Database\Eloquent as Eloquent;

class User extends Eloquent\Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    public $timestamps = false;


    function commande()
    {
        return
            $this->belongsToMany('Produit', 'commande', 'id_user', 'id')
                ->withPivot(['id_comm', 'date_comm', 'quantite']);
    }

}
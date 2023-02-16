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
            $this->belongsToMany('Application\models\Produit', 'commande', 'id_user', 'id_prod')
                ->withPivot(['id_comm', 'date_comm', 'quantite']);
    }

    function favoris(){
        return $this->belongsToMany('Application\models\Produit', 'favoris', 'id_user', 'id_prod');
    }

}
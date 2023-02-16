<?php

namespace Application\identity\model;
use \Illuminate\Database\Eloquent as Eloquent;

class Produit extends Eloquent\Model{
    protected $table = 'produit';
    protected $primaryKey = 'id';
    public $timestamps = false;


    function categorie(){
        return $this->belongsTo('Application\identity\model\Categorie', 'categorie');
    }


    function commande(){
        return
            $this->belongsToMany('Application\identity\model\User', 'commande', 'id', 'id_user')
                ->withPivot(['id_comm', 'date_comm', 'quantite']);
    }
}
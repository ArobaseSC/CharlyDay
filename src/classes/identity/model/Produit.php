<?php

namespace Application\identity\model;
use \Illuminate\Database\Eloquent as Eloquent;

class Produit extends Eloquent\Model{

    protected $table = 'produit';
    protected $primaryKey = 'id';
    public $timestamps = false;

    private int $id;
    private int $categorie;
    private string $nom;
    private float $prix;
    private int $poids;
    private string $description;
    private string $detail;
    private string $lieu;
    private int $distance;
    private float $latitude;
    private float $longitude;

    function categorie(){
        return $this->belongsTo('Application\identity\model\Categorie', 'categorie');
    }


    function commande(){
        return
            $this->belongsToMany('Application\identity\model\User', 'commande', 'id', 'id_user')
                ->withPivot(['id_comm', 'date_comm', 'quantite']);
    }
}
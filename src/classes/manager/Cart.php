<?php

namespace Application\manager;

class Cart
{

    private $produit;
    private $quantite;

    public function __construct($prod, $qte)
    {
        $this->produit = $prod;
        $this->quantite = $qte;
    }

    public function __set(string $at, mixed $val): void
    {
        if (property_exists($this, $at)) {
            $this->$at = $val;
        }else{
            throw new \Exception("Attribut $at inexistant");
        }
    }

    public function __get(string $at): mixed
    {
        if (property_exists($this, $at)) {
            return $this->$at;
        }else{
            throw new \Exception("Attribut $at inexistant");
        }
    }

}
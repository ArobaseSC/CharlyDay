<?php

namespace Application\manager;

class CartManager
{

    private static array $liste = [];

    public static function loadCart(): void
    {
        if (self::hasSavedCart()) {
            self::$liste = unserialize($_SESSION['cart']);
        }
    }

    public static function saveCart(): void
    {
        $_SESSION['cart'] = serialize(self::$liste);
    }

    public static function addProduct($product, $qte)
    {
        if(!self::alreadyInCart($product)){
            self::$liste[] = new Cart($product, $qte);
        } else {
            $data = self::getProductByName($product->nom);
            $prd = $data->__get('produit');
            $qtite = $data->__get('quantite');
            self::removeProduct($prd);
            self::$liste[] = new Cart($product, $qtite+$qte);
        }
    }

    public static function removeProduct($product) : void
    {
        if(self::alreadyInCart($product)) {
            $data = self::getProductByName($product->nom);
            if (($i = array_search($data, self::$liste)) !== false){
                unset(self::$liste[$i]);
            }
        }
    }

    public static function getCart() : array
    {
        return self::$liste;
    }

    public static function alreadyInCart($product) : bool
    {
        foreach (self::$liste as $e){
            if($e->produit->nom == $product->nom){
                return true;
            }
        }
        return false;
    }

    public static function getProductByName($name) : mixed
    {
        foreach (self::$liste as $e){
            if($e->produit->nom == $name){
                return $e;
            }
        }
        return null;
    }

    public static function hasSavedCart(): bool
    {
        return isset($_SESSION['cart']);
    }

}
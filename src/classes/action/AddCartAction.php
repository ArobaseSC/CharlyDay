<?php

namespace Application\action;

use Application\identity\model\Produit;
use Application\manager\CartManager;

class AddCartAction extends Action
{

    public function execute(): string
    {

        $html = "ajout d'un produit dans le panier";

        CartManager::loadCart();
        $produit = Produit::where("id", "=", "1")->first();
        CartManager::addProduct($produit);
        CartManager::saveCart();

        return $html;

    }

}
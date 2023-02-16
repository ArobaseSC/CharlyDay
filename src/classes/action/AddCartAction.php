<?php

namespace Application\action;

use Application\identity\model\Produit;
use Application\manager\CartManager;

class AddCartAction extends Action
{

    public function execute(): string
    {

        $id = $_GET['id'];

        $html = "ajout d'un produit dans le panier";

        CartManager::loadCart();
        $produit = Produit::where("id", "=", $id)->first();
        CartManager::addProduct($produit);
        CartManager::saveCart();

        return $html;

    }

}
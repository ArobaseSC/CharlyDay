<?php

namespace Application\action;

use Application\identity\model\Produit;
use Application\manager\CartManager;

class AddCartAction extends Action
{

    public function execute(): string
    {

        $id_product = $_GET['id_product'];

        $html = "ajout d'un produit dans le panier";

        CartManager::loadCart();
        $produit = Produit::where("id", "=", $id_product)->first();
        CartManager::addProduct($produit);
        CartManager::saveCart();

        return $html;

    }

}
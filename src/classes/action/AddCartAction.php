<?php

namespace Application\action;

use Application\identity\model\Produit;
use Application\manager\CartManager;

class AddCartAction extends Action
{

    public function execute()
    {

        $id_product = $_GET['id_product'];
        $quantite = $_GET['quantite'];

        $html = "ajout d'un produit dans le panier";

        CartManager::loadCart();
        $produit = Produit::where("id", "=", $id_product)->first();
        CartManager::addProduct($produit, $quantite);
        CartManager::saveCart();

        echo $html;

    }

}
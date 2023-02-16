<?php

namespace Application\action;

use Application\models\Produit;
use Application\manager\CartManager;

class AddCartAction extends Action
{

    public function execute()
    {

        $id_product = $_GET['id_product'];
        $quantite = $_GET['quantite'];


        CartManager::loadCart();
        $produit = Produit::where("id", "=", $id_product)->first();
        CartManager::addProduct($produit, $quantite);
        CartManager::saveCart();

        // on va dans le panier
        header("Location: ?action=cart");

    }

}
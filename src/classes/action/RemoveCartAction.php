<?php

namespace Application\action;

use Application\identity\model\Produit;
use Application\manager\CartManager;

class RemoveCartAction extends Action
{

    public function execute()
    {

        if(!isset($_GET['id_product'])){
            return;
        }

        $id_product = $_GET['id_product'];

        CartManager::loadCart();
        $produit = Produit::where("id", "=", $id_product)->first();
        CartManager::removeProduct($produit);
        CartManager::saveCart();

        header('Location: ?action=cart');


    }

}
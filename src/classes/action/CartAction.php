<?php

namespace Application\action;

use Application\manager\CartManager;

class CartAction extends Action
{

    public function execute()
    {

        require_once 'src/views/Header.php';

        $html = <<< HEAD
            <!-- Start Cart  -->
            <div class="cart-box-main">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-main table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Nom du produit</th>
                                            <th>Prix à l'unité</th>
                                            <th>Quantité</th>
                                            <th>Prix</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
HEAD;

        CartManager::loadCart();
        $carts = CartManager::getCart();
        $prixTotal = 0;
        foreach($carts as $cart){

            $pr = $cart->__get('produit');
            $qte = $cart->__get('quantite');

            if($pr->poids == 0){
                $prix = $pr->prix * ($qte / 1000);
                $refQte = "grammes";
            } else {
                $prix = $pr->prix * $qte;
                $refQte = "unité(s)";
            }

            $prixTotal += $prix;

            $html .= "<tr>";
            // image
            $html .= "<td class='thumbnail-img'><a href='#'><img class='img-fluid' src='images/$pr->id.jpg' alt=''/></a></td>";
            // nom
            $html .= "<td class='name-pr'><a href='#'>$pr->nom</a></td>";
            // prix
            $html .= "<td class='price-pr'><p>$pr->prix €</p></td>";
            // qte
                $html .= "<td class='price-pr'><p>$qte $refQte</p></td>";
            // total (qte * prix)
            $html .= "<td class='total-pr'><p>$prix €</p></td>";
            // delete
            $html .= "<td class='remove-pr'><a href=''#'><i class='fas fa-times'></i></a></td>";
            $html .= "</tr>";


        }

         $html .= <<< HEAD
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
        
                    <div class="row my-5">
                        <div class="col-lg-8 col-sm-12"></div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="order-box">
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Total du panier</h5>
                                    <div class="ml-auto h5">$prixTotal €</div>
                                </div>
                                <hr> </div>
                        </div>
                        <div class="col-12 d-flex shopping-box"><a href="checkout.html" class="ml-auto btn hvr-hover">Passer commande</a> </div>
                    </div>
        
                </div>
            </div>
            <!-- End Cart -->
        HEAD;


        echo $html;

        require_once 'src/views/Footer.php';

    }

}
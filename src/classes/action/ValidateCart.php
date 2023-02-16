<?php

namespace Application\action;

use Application\manager\CartManager;
use Application\models\User;

class ValidateCart extends Action
{

    public function execute()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!isset($_SESSION['loggedUser'])){
                header("Location: ?action=conn_log");
            }

            $utilisateur = unserialize($_SESSION['loggedUser']);
            $user = User::where('id_user', '=', $utilisateur->id)->first();
            CartManager::loadCart();
            $carts = CartManager::getCart();

            $date = $_POST['date'];

            foreach ($carts as $cart){
                $produit = $cart->__get('produit');
                $qte = $cart->__get('quantite');

                $user->commande()->attach([$produit->id=>['date_comm'=>$date, 'quantite'=>$qte]]);

            }

            CartManager::destroyCart();
            echo "Merci pour votre commande ! Venez le récupérer le $date <br>";
            echo "<a href='?action=shop'>Retourner à la boutique</a>";

            return;

        }

        require_once 'src/views/Header.php';
        require_once 'src/views/EarlyCheckout.php';

        $html = <<< HEAD
        <!-- Start Cart  -->
        <div class="cart-box-main">
            <div class="container">
                <form class="needs-validation" method="post" action="?action=checkout">
                    <div class="col-md-12 col-lg-12">
            
                        <div class="checkout-address">
                            <div class="title-left">
                                <h3>Date de retrait</h3>
                            </div>
                                <div class="mb-3">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" name="date" required>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12">
                        <div class="odr-box">
                            <div class="title-left">
                                <h3>Résumé de votre panier</h3>
                            </div>
                        
        HEAD;

        CartManager::loadCart();
        $carts = CartManager::getCart();

        $prixTotal = 0;
        foreach ($carts as $cart) {

            $pr = $cart->__get('produit');
            $qte = $cart->__get('quantite');

            if ($pr->poids == 0) {
                $prix = $pr->prix * ($qte / 1000);
                $refQte = "grammes";
                $refPrix = "/ kg";
                $empreinte = $pr->distance * ($qte / 1000);
            } else {
                $prix = $pr->prix * $qte;
                $refQte = "unité(s)";
                $refPrix = "/ unité";
                $empreinte = $pr->distance * $pr->poids;
            }

            $prixTotal += $prix;


            $html .= "<div class='rounded p-2 bg-light'>";
            $html .= "<div class='media mb-2 border-bottom'>";
            $html .= "<div class='media-body'><a href='?action=view_product&id_product=$pr->id'>$pr->nom</a>";
            $html .= "<div class='small text-muted'>Prix : $pr->prix € $refPrix <span class='mx-2'>|</span> Quantité : $qte $refQte<span
         class='mx-2'>|</span>Empreinte carbone : $empreinte g CO2e <span class='mx-2'>|</span> Total : $prix €";
            $html .= "</div>";
            $html .= "</div>";
            $html .= "</div>";
            $html .= "</div>";

        }


        $html .= <<< HEAD
                        
                        <div class="d-flex gr-total">
                            <h5>Total</h5>
                            <div class="ml-auto h5"> $prixTotal €</div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="col-12 d-flex shopping-box">
                    <button type="submit" class="ml-auto btn hvr-hover" style="color: white; font-weight: 700"><a>Confirmer l'achat</a></button>
                </div>
                </form>
            </div>
        </div>
        <!-- End Cart -->
        HEAD;

        echo $html;

        require_once 'src/views/Footer.php';

    }

}
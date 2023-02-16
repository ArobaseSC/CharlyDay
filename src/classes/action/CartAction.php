<?php

namespace Application\action;

use Application\identity\model\Produit;
use Application\manager\CartManager;

class CartAction extends Action
{

    public function execute(): string
    {
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
                                            <th>Prix</th>
                                            <th>Quantité</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
            HEAD;

        CartManager::loadCart();
        $produits = CartManager::getCart();
        foreach($produits as $pr){

            // image
            $html .= "<tr><td class='thumbnail-img'><a href='#'><img class='img-fluid' src='images/$pr->id.jpg' alt=''/></a></td></tr>";


        }

        /**
                                        <tr>
                                            <td class="thumbnail-img">
                                                <a href="#">
                                                    <img class="img-fluid" src="images/img-pro-01.jpg" alt="" />
                                                </a>
                                            </td>
                                            <td class="name-pr">
                                                <a href="#">Lorem ipsum dolor sit amet</a>
                                            </td>
                                            <td class="price-pr">
                                                <p>$ 80.0</p>
                                            </td>
                                            <td class="quantity-box"><input type="number" size="4" value="1" min="0" step="1" class="c-input-text qty text"></td>
                                            <td class="total-pr">
                                                <p>$ 80.0</p>
                                            </td>
                                            <td class="remove-pr">
                                                <a href="#">
                                            <i class="fas fa-times"></i>
                                        </a>
                                            </td>
                                        </tr>
         **/

         $html .= <<< HEAD
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
        
                    <div class="row my-5">
                        <div class="col-lg-6 col-sm-6">
                            <div class="update-box">
                                <input value="Mettre à jour le panier" type="submit">
                            </div>
                        </div>
                    </div>
        
                    <div class="row my-5">
                        <div class="col-lg-8 col-sm-12"></div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="order-box">
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Total</h5>
                                    <div class="ml-auto h5"> $ 388 </div>
                                </div>
                                <hr> </div>
                        </div>
                        <div class="col-12 d-flex shopping-box"><a href="checkout.html" class="ml-auto btn hvr-hover">Passer commande</a> </div>
                    </div>
        
                </div>
            </div>
            <!-- End Cart -->
        HEAD;

        return $html;

    }

}
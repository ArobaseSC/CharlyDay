<?php

namespace Application\action;

class ValidateCart extends Action
{

    public function execute()
    {

        require_once 'src/views/Header.php';
        require_once 'src/views/EarlyCheckout.php';

        $html = <<< HEAD
        <!-- Start Cart  -->
        <div class="cart-box-main">
            <div class="container">
                <div class="col-md-12 col-lg-12">
        
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Date de retrait</h3>
                        </div>
                        <form class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="username">Date</label>
                                <input type="date" class="form-control" id="username" placeholder="" required>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12">
                    <div class="odr-box">
                        <div class="title-left">
                            <h3>Résumé de votre panier</h3>
                        </div>
                        <div class="rounded p-2 bg-light">
                            <div class="media mb-2 border-bottom">
                                <div class="media-body"><a href="detail.html"> Lorem ipsum dolor sit amet</a>
                                    <div class="small text-muted">Price: $80.00 <span class="mx-2">|</span> Qty: 1 <span
                                                class="mx-2">|</span> Subtotal: $80.00
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gr-total">
                            <h5>Total</h5>
                            <div class="ml-auto h5"> $ 388</div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="col-12 d-flex shopping-box"><a href="#" class="ml-auto btn hvr-hover">Confirmer
                        l'achat</a></div>
            </div>
        
        </div>
        <!-- End Cart -->
        HEAD;

        echo $html;

        require_once 'src/views/Footer.php';

    }

}
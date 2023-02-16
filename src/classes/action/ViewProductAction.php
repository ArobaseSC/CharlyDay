<?php

namespace Application\action;

use Application\models\Produit;

class ViewProductAction extends Action {

    public function execute(){
        if (!isset($_GET['id_product'])){return;}


        require_once 'src/views/Header.php';
        require_once 'src/views/EarlyViewProduct.php';


        $id_product = $_GET['id_product'];
        // on recupere le produit courant
        $produit = Produit::where("id", "=", $id_product)->first();

        // si le prix est au kilo
        if($produit->poids === 0){
            $prix = "{$produit->prix}€ au kilo";
            $demande = "grammes";
            $start = 250;
        }else{
            $prix = "{$produit->prix}€";
            $demande = "quantité";
            $start = 1;
        }




       $html = <<<END
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div>
                        <img class="d-block w-100" src="images/{$produit->id}.jpg">
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2>$produit->nom</h2>
                        <h5>$prix</h5>
                        <p class="available-stock"><span> More than 20 available / <a href="#">8 sold </a></span><p>
						<h4>Description :</h4>
						<p>$produit->description</p>
						<ul>
							<li>
								<div class="form-group quantity-box">
									<label class="control-label">$demande</label>
									<input class="form-control" value=$start min="1" type="number">
								</div>
							</li>
						</ul>

						<div class="price-box-bar">
							<div class="cart-and-bay-btn">
								<a class="btn hvr-hover" href="#">Ajouter au panier</a>
								<a class="btn hvr-hover" href="#"><i class="fas fa-heart"></i> Ajouté aux favoris</a>
							</div>
						</div>
                    </div>
                </div>
            </div>
END;


        echo $html;
        require_once 'src/views/LateViewProduct.php';
        require_once 'src/views/Footer.php';




    }
}
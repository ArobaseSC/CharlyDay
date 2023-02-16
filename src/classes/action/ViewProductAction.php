<?php

namespace Application\action;

use Application\models\Produit;

class ViewProductAction extends Action {

    public function execute(){
        if (!isset($_GET['id_product'])){return;}


        // si on veut ajouter au panier
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $quantite = filter_var($_POST['quantite'], FILTER_SANITIZE_NUMBER_INT);
            var_dump($quantite);
            header("Location: ?action=add_cart&id_product={$_GET['id_product']}&quantite=$quantite");
        }




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
						<h4>Description :</h4>
						<p>$produit->description</p>
						<form method="post" action="?action=view_product&id_product={$produit->id}&quantite=2">
                            <ul>
                                <li>
                                    <div class="form-group quantity-box">
                                        <label class="control-label">$demande</label>
                                        <input id="input_quantite" class="form-control" name="quantite" value=$start min="1" type="number">
                                    </div>
                                </li>
                            </ul>
    
                            <div class="price-box-bar">
                                <div class="cart-and-bay-btn">
                                    <button type="submit" class="btn hvr-hover" style="color: white; font-weight: 700"><a>Ajouter au panier</a></button>
                     
                                    <a class="btn hvr-hover" href="#"><i class="fas fa-heart"></i> Ajouté aux favoris</a>
                                </div>
                            </div>
						</form>
                    </div>
                </div>
            </div>
END;


        echo $html;
        require_once 'src/views/LateViewProduct.php';
        require_once 'src/views/Footer.php';




    }
}
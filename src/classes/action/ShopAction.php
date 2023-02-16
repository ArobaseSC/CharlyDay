<?php

namespace Application\action;

use Application\models\Produit;

class ShopAction extends Action
{

    public function execute()
    {
        require_once 'src/views/Header.php';
        require_once 'src/views/EarlyShop.php';

        $nbProduits = Produit::count();
        $html = "
                            <p>{$nbProduits} Résultats</p>
                        </div>
                    </div>

                    <div class=\"product-categorie-box\">
                        <div class=\"tab-content\">

                            <div role=\"tabpanel\" class=\"tab-pane fade show active\" id=\"list-view\">";

        $produits = Produit::get();



        foreach ($produits as $produit) {
            $html .= <<<END
                                    <div class="list-view-box">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <div class="type-lb">
                                                        </div>
                                                            <img src="images/{$produit->id}.jpg" class="img-fluid" alt="Image">
                                                        <div class="mask-icon">
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist">Ajouter au panier</a></li>
                                                                <li><a href="?action=add-star&id_produit={$produit->id}" class="star" type="checkbox" checked></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                <div class="why-text full-width">
                                                     <a href="?action=view_product&id_product={$produit->id}">
                                                        <h4>{$produit->nom}</h4>
                                                    </a>

END;

            if ($produit->poids == 0) {
                $html .= "<h5> {$produit->prix}€ au kilo</h5>";
            } else {
                $html .= "<h5> {$produit->prix}€</h5>";
            }

            $html .= <<<END
                                                    <p>{$produit->description}</p>
                                                    <a class="btn hvr-hover" href="#">Add to Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
END;
        }


        echo $html;

        require_once 'src/views/LateShop.php';
        require_once 'src/views/Footer.php';
    }
}
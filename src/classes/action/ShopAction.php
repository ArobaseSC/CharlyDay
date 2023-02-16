<?php

namespace Application\action;

use Application\models\Categorie;
use Application\models\Produit;

class ShopAction extends Action
{

    public function execute()
    {
        require_once 'src/views/Header.php';
        require_once 'src/views/EarlyShop.php';

        $page = $_GET['page'] ?? 0;

        try {
            $page = (int)$page;
        } catch (\Exception $e) {
            $page = 0;
        }

        $numCategorie = $_GET['categorie'] ?? 0;
        try {
            $numCategorie = (int)$numCategorie;
        } catch (\Exception $e) {
            $numCategorie = 0;
        }

        $tri = $_GET['tri'] ?? 0;
        try {
            $tri = (int)$tri;
        } catch (\Exception $e) {
            $tri = 0;
        }

        $temp = '';

        if ($tri != 0) {
            $temp .= '&tri=' . $tri;
        }

        if ($numCategorie != 0) {
            $temp .= '&categorie=' . $numCategorie;
            $categorie = Categorie::where('id', $numCategorie)->first();
            $produits = $categorie->produits();
            $nbProduits = $categorie->produits()->count();
        } else {
            $produits = Produit::where('id', '>', '0');
            $nbProduits = Produit::count();
        }

        if (isset($_GET['searchBar'])) {
            $temp .= '&searchBar=' . $_GET['searchBar'];
            $produits = $produits->where('nom', 'like', '%' . $_GET['searchBar'] . '%')
                ->orWhere('description', 'like', '%' . $_GET['searchBar'] . '%')
                ->orWhere('lieu', 'like', '%' . $_GET['searchBar'] . '%');
            $nbProduits = $produits->count();
        }

        $triSelect = <<<END
                            <div class="toolbar-sorter-right">
                                <span>Trier par </span>
                                <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
                                    <option name="tri" value="0" data-display="Select">Aucun</option>
                                    <option  name="tri" value="1"><a href="?action=shop&tri=1">Prix Bas -> Prix Haut</a></option>
                                    <option  name="tri" value="2">Prix Haut → Prix Bas</option>
                                    <option  name="tri" value="3">Nom A → Z</option>
                                    <option  name="tri" value="4">Nom Z → A</option>
                                </select>
                            </div>
                END;

        if ($tri == 1) {
            $produits = $produits->orderBy('prix', 'asc');
        } else if ($tri == 2) {
            $produits = $produits->orderBy('prix', 'desc');
        } else if ($tri == 3) {
            $produits = $produits->orderBy('nom', 'asc');
        } else if ($tri == 4) {
            $produits = $produits->orderBy('nom', 'desc');
        }

        $nbMaxPages = ceil($nbProduits / 5);

        if ($page + 1 > $nbMaxPages) {
            $page = floor($nbProduits / 5 - 1 );
        }

        $html = <<<END
                            <div class="col-12 col-sm-4 text-center text-sm-right" style="max-width: 17%">
                            <p style="width: 100px">{$nbProduits} Résultats</ps>
                            
                        </div> 
                    </div>

                    <div class="product-categorie-box">
                        <div class="tab-content">
                            

                            <div role="tabpanel" class="tab-pane fade show active" id="list-view">
END;

        $produits = $produits->get()->skip($page * 5)->take(5);


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
                                                                
                                                                <li><a href="?action=add-star&id_produit={$produit->id}" class="star"><input type="checkbox" checked></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                <div class="why-text full-width">
                                                     <a style='padding: 0' href="?action=view_product&id_product={$produit->id}">
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


        $html .= <<<END
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                        <div class="product-categori">
                            <div class="search-product">
                                <form method='get'>
                                    <input type="hidden" name="action" value="shop">
                                    <input type="hidden" name="page" value="0">
                    END;

        if ($numCategorie != 0) {
            $html .= "<input type='hidden' name='categorie' value='{$_GET['categorie']}'>";
        }

        $html .= <<<END
                                    <input class="form-control" placeholder="Search here..." type="text" name="searchBar">
                                    <button type="submit"> <i class="fa fa-search"></i> </button>
                                </form>
                            </div>
                            <div class="filter-sidebar-left">
                                <div class="title-left">
                                    <h3>Categories</h3>
                                </div>
                                <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                    END;

        $html .= "<a ";
        if ($numCategorie == 0) {
            $html .= "style='font-weight: bold'";
        }
        $total = Produit::count();
        $html .= <<<END
                        href="?action=shop&page=0" class="list-group-item list-group-item-action">Tous les articles<small class="text-muted"> ({$total})</small></a>   
            END;


        $categories = Categorie::get();
        foreach ($categories as $categorie) {
            $html .= "<a ";
            if ($numCategorie == $categorie->id) {
                $html .= "style='font-weight: bold'";
            }
            $html .= <<<END
                             href="?action=shop&page=0&categorie={$categorie->id}" class="list-group-item list-group-item-action"> {$categorie->nom} <small class="text-muted">({$categorie->produits()->count()})</small></a>
            END;

        }
        $html .= <<<END
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    <!-- End Shop Page -->
                    END;


        echo $triSelect;

        if ($nbMaxPages > 1) {
            $pagination = '<ul class="pagination">';
            $pagination .= "<li class='page-item ";
            if ($page < 1) {
                $pagination .= "disabled";
            }
            $pageMoinsUn = $page - 1;
            $pagination .= "'><a class='page-link' href='?action=shop{$temp}&page={$pageMoinsUn}'>Précédent</a></li>";

            for ($i = 0; $i < $nbMaxPages; $i++) {
                $pagination .= "<li class='page-item ";
                if ($i == $page) {
                    $pagination .= "active";
                }
                $iPlusUn = $i + 1;
                $pagination .= "'><a class='page-link' href='?action=shop{$temp}&page={$i}'>{$iPlusUn}</a></li>";
            }

            $pagination .= "<li class='page-item ";
            if ($page + 1 >= $nbMaxPages) {
                $pagination .= "disabled";
            }
            $pagePlusUn = $page + 1;
            $pagination .= "'><a class='page-link' href='?action=shop{$temp}&page={$pagePlusUn}'>Suivant</a></li>";

            $pagination .= '</div>';
            echo $pagination;
        } else {
            echo '</div>';
        }


        echo $html;

        require_once 'src/views/LateShop.php';
        require_once 'src/views/Footer.php';
    }
}
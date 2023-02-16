<?php

namespace Application\action;

class CompteAction extends Action
{

    public function execute()
    {
        /**if($_SESSION["loggedUser"] === null){
            header("Location: ?action=login");
        }else{*/
            require_once 'src/views/Header.php';
            $html = <<<END
                <div class="compteContainer">
                <h1>Mon compte</h1>
                
                <h2>Information Personnel</h2>
                <div>
                    <div>
                        <p>Nom : </p>
                        <p>Prénom : </p>
                        <p>Email : </p>
                    </div>
                </div>
                <div class="Favori_product">
                <h2>Produit Favori</h2>
END;

            $html.= <<<END
                    <div class="product">
                        <div>
                            <img src="https://www.lesjardinsdegaia.com/1210-large_default/lot-de-2-figurines-de-jardin-les-2-amoureux.jpg" alt="image produit">
                            <p>nom du produit</p>
                            <p>prix du produit</p>
                        </div>
                    </div>
END;
            $html.= <<<END
                </div>
                <div class="CommandHistory">
                    <h2>Historique des commandes</h2>
END;
            $html.= <<<END
                        <div class="command">
                            <div>
                                <p>date de la commande</p>
                                <p>nom du produit</p>
                                <p>prix du produit</p>
                            </div>
                        </div>
END;
            $html.= <<<END
                </div>
            </div>      
END;
            echo $html;
            require_once 'src/views/Footer.php';


        }
    //}
}
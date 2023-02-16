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
                <div class="account-container">
  <div class="personal-info">
    <h2>Informations personnelles</h2>
    <p>Nom : John Doe</p>
    <p>Adresse : 123 Rue Principale</p>
    <p>Ville : Montréal</p>
    <p>Pays : Canada</p>
    <p>Email : johndoe@gmail.com</p>
  </div>
  <div class="favorites">
    <h2>Produits favoris</h2>
    <ul>
END;

            $html.= <<<END
                <li>
                    <div class="product">
                        <div>
                            <img src="https://www.lesjardinsdegaia.com/1210-large_default/lot-de-2-figurines-de-jardin-les-2-amoureux.jpg" alt="image produit">
                            <p>nom du produit</p>
                            <p>prix du produit</p>
                        </div>
                    </div>
                </li>   
END;
            $html.= <<<END
                </div>
                <div class="order-history">
                <h2>Historique des commandes</h2>
                <table>
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Produit</th>
                          <th>Prix</th>
                        </tr>
                      </thead>
                <tbody>
END;
            $html.= <<<END
                    <tr>
                        <td>01/01/2022</td>
                        <td>Produit 1</td>
                        <td>49.99 $</td>
                    </tr>
END;
            $html.= <<<END
                </tbody>
            </table>
            </div>
            </div>     
END;
            echo $html;
            require_once 'src/views/Footer.php';


        }
    //}
}
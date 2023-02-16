<?php

namespace Application\action;

use Application\models\User;

class CompteAction extends Action
{

    public function execute()
    {

        // si l'utilisateur n'est pas co, on va sur le shop
        if (!isset($_SESSION['loggedUser'])){
            header("Location: ?action=shop");
            return;
        }

        // on recupere l'user
        $utilisateur = unserialize($_SESSION['loggedUser']);

        $user = User::where('id_user', '=', $utilisateur->id)->first();

            require_once 'src/views/Header.php';
            $html = <<<END
                <div class="account-container">
  <div class="personal-info">
    <h2>Informations personnelles</h2>
    <p>Nom : $user->nom</p>
    <p>Prenom : $user->prenom</p>
    <p>Email : $user->email</p>
    <p>Télephone : $user->tel</p>
  </div>
  <div class="favorites">
    <h2>Produits favoris</h2>
    <ul>
END;

            $produits = $user->favoris()->get();
            foreach ($produits as $produit){

                if ($produit->poids === 0) {
                    $prix = "{$produit->prix}€ au kilo";
                } else {
                    $prix = "{$produit->prix}€";
                }

            $html.= <<<END
                <li>
                    <div class="compte_product">
                        <div>
                            <img src="images/{$produit->id}.jpg" alt="image produit">
                            <p>$produit->nom</p>
                            <p>$prix</p>
                        </div>
                    </div>
                </li>   
END;
            }
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
<?php

namespace Application\action;

use Application\models\User;

class AddStarAction extends Action{

    public function execute()
    {
        // si personne n'est connecter
        if (!isset($_SESSION['loggedUser'])){
            header("Location: ?action=conn_log");
            return;
        }

        if (!isset($_GET['id_produit'])){
            echo "non";
            return;
        }

        // sinon
        // on recupere le user
        $utilisateur = unserialize($_SESSION['loggedUser']);
        $user = User::where("id_user", "=", $utilisateur->id)->first();


        // on recupere la table pivot
        $user->favoris()->toggle($_GET['id_produit']);

        // on retourne au shop
        header("Location: ?action=shop");


    }
}
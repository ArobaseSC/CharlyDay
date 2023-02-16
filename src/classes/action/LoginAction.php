<?php

namespace Application\action;

use Application\identity\authentication\service\AuthenticationIdentityService;
use Application\identity\Utilisateur;
use Application\models\User;

class LoginAction extends Action
{

    public function execute(){


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
            $user = User::where("email", "=", $email)->first();
            if ($user === null) {
                echo "erreur de connexion, utilisateur incconu";
                return;
            }
            $hash = $user->mdp;

            // si ce n'est pas le bon password
            if (!password_verify($password, $hash)) {
                echo "Mauvais mot de passe";
                return;
            }



            $html = "Bienvenue {$user->nom}";
            // on l'enregistre dans la session
            $_SESSION["loggedUser"] = serialize($user);

            $utilisateur = new Utilisateur($user);
            // on enregistre le user dans la session
            $_SESSION['loggedUser'] = serialize($utilisateur);
            // on va sur la page de la boutique
            header("Location: ?action=shop");

        }
    }






}
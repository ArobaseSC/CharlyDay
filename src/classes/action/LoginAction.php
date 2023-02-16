<?php

namespace Application\action;

use Application\models\User;

class LoginAction extends Action
{

    public function execute(){


        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $html = <<<END
            <form action="?action=login" method="post">
                <h1>Se connecter</h1>
                <div>
                    <div>
                            <input type="email" name="email" oncopy="return false" onpaste="return false" placeholder="Email">
                            <input type="password" name="password" oncopy="return false" onpaste="return false" placeholder="Mot de passe">
                    </div>
                </div>
                <button type="submit"> connecter</button>
                <span class="dark:text-white pt-5">Pas encore de compte ? <a href="?action=sign-up" </a></span>
            </form>
            
END;
        }else{
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);

            $user = User::where("email", "=", $email)->where("mdp", "=", $password)->first();

            if ($user === null){
                $html = "erreur de connexion, utilisateur incconu";
            }else{
                $html = "Bienvenu {$user->nom}";
                // on l'enregistre dans la session
                $_SESSION["loggedUser"] = serialize($user);
            }

        }


        echo $html;


    }






}
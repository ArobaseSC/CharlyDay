<?php

namespace Application\action;

use Application\identity\authentication\service\PasswordStrengthCheckerService;
use Application\models\User;

class InscriptionAction extends Action {

    public function execute(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
            $tel = filter_var($_POST['tel'], FILTER_SANITIZE_SPECIAL_CHARS);
            $nom = filter_var($_POST['nom'], FILTER_SANITIZE_SPECIAL_CHARS);
            $prenom = filter_var($_POST['prenom'], FILTER_SANITIZE_SPECIAL_CHARS);
            $passwordCheck = filter_var($_POST['passwrd_check'], FILTER_SANITIZE_SPECIAL_CHARS);



            // on verifie la double auth
            if($password !== $passwordCheck){
                echo "Mot de passe non identique";
                return;
            }

            // on verifie la robustesse du mdp
            if (!PasswordStrengthCheckerService::check($password)){
                echo "Mot de passe pas assez robuste";
                return;
            }


            $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);



            // on cree un user à partir de ces infos
            $user = new User();
            $user->email = $email;
            $user->mdp = $hash;
            $user->tel = $tel;
            $user->nom = $nom;
            $user->prenom = $prenom;

            $user->save();
            // on enregistre le user dans la session
            $_SESSION['loggedUser'] = $user;
            // on va sur la page de la boutique
            header("Location: ?action=shop");
        }
    }
}
<?php

namespace Application\action;

use Application\identity\authentication\service\AuthenticationIdentityService;

class LoginAction extends Action
{
    public function execute(): void
    {

        // si l'utilisateur a déjà une session
        //TODO

        // méthode GET, retourne la réponse HTML de base

        require_once 'src/views/Header.php';

        // méthode POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && filter_var($_POST['password'], FILTER_SANITIZE_STRING)) {
                $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
                if(AuthenticationIdentityService::authenticate($email, $password)!=null){
                    $_SESSION['user'] = AuthenticationIdentityService::authenticate($email, $password);
                }else{
                    $html = $this->renderHtml(true);
                }




                // si les données ne passent pas les filter, alors on retourne une erreur
            }

        }else{
            $html = $this->renderHtml(false);
        }

        echo $html;
        require_once 'src/views/Footer.php';
    }

    public function renderHtml(bool $err):String{

        $html = <<<HEREDOC
            <form method="post" action="?action=login">             
                <div class="connexion">
                   
                    <div class="login_container">
                        <h1 id="title">Se connecter</h1>
                       
                        <div class="emailControl">
                                <input type="email" name="email" id="id_email" placeholder="E-mail" class="textfield">      
                        </div>
                        
                        <div class="passwordControl">
                                <input type="password" name="password" id="id_password" placeholder="Mot de passe" class="textfield">
                        </div>
HEREDOC;
        if ($err){
            $html.= <<<HERE
                <div class="error">
                        <p style="color: red">Email ou mot de passe incorrect</p>
                </div>
HERE;
        }
        $html.= <<<HEREDOC
                                <div class="Signup">
                                        <p><a href="?action=forgetPassword" style="color: red" >Mot de passe oublié ?</a></p>
                                </div>
                                <div class="Signup">
                                        <p><a href="?action=signup" style="color: red" >Pas encore inscrit ?</a></p>
                                </div>
                                <div class="button">
                                        <input type="submit" value="Se connecter" class="button">
                                </div>      
                            </div>
                        </div>  
                    </form>
HEREDOC;

        return $html;
    }



}
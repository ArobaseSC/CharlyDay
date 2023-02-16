<?php

namespace Application\action;

class LogConnAction extends Action {

    public function execute()
    {
        require_once 'src/views/Header.php';

       $html = <<<END
<div class="login">
    <div class="container" id="fond">
        <div class="logo">
            <i class="fas fa-user"></i>
        </div>

        <div class="tab-body" data-id="connexion">
            <form action="?action=login" method="post">
                <div class="row">
                    <i class="far fa-user"></i>
                    <input name="email" type="email" class="input" placeholder="Adresse Mail">
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input name="password" placeholder="Mot de Passe" type="password" class="input">
                </div>
                <a href="#" class="link">Mot de passe oublié ?</a>
                <button class="btn" type="submit">Connexion</button>
            </form>
        </div>

        <div class="tab-body" data-id="inscription">
            <form action="?action=inscription" method="post">
                <div class="row">
                    <i class="far fa-user"></i>
                    <input name="nom" type="nom" class="input" placeholder="Nom">
                </div>
                <div class="row">
                    <i class="far fa-user"></i>
                    <input name="prenom" type="prenom" class="input" placeholder="Prénom">
                </div>

                <div class="row">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <input name="tel" type="number" class="input" placeholder="Numéro de Téléphone">
                </div>

                <div class="row">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <input name="email" type="email" class="input" placeholder="Adresse Mail">
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input name="password" type="password" class="input" placeholder="Mot de Passe">
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input name="passwrd_check" type="password" class="input" placeholder="Confirmer Mot de Passe">
                </div>
                <button class="btn" type="submit">Inscription</button>
            </form>
        </div>

        <div class="tab-footer">
            <a class="tab-link active" data-ref="connexion" href="javascript:void(0)">Connexion</a>
            <a class="tab-link" data-ref="inscription" href="javascript:void(0)">Inscription</a>
        </div>
    </div>
</div>
<script src="./js/LoginAnimation.js" defer></script>





END;


        echo $html;
        require_once 'src/views/Footer.php';

    }
}
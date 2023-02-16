<?php

namespace Application\action;

use Application\manager\CartManager;

class ValidateCart extends Action
{

    public function execute()
    {

        require_once 'src/views/Header.php';
        require_once 'src/views/EarlyCheckout.php';



        require_once 'src/views/Footer.php';

    }

}
<?php

namespace Application\action;

class ActionAccueil extends Action
{
    public function execute()
    {
        require_once 'src/views/Header.php';
        require_once 'src/views/EarlyAccueil.php';
        require_once 'src/views/Footer.php';
    }


}
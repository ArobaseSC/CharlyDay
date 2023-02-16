<?php

namespace Application\action;

class AboutAction extends Action
{

    public function execute()
    {
        require_once 'src/views/Header.php';
        require_once 'src/views/About.php';
        require_once 'src/views/Footer.php';
    }
}
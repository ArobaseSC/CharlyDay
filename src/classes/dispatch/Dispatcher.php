<?php

declare(strict_types=1);

namespace Application\dispatch;

use Application\action\AboutAction;
use Application\action\AddStarAction;
use Application\action\CompteAction;
use Application\action\InscriptionAction;
use Application\action\LogConnAction;
use Application\action\LoginAction;

use Application\action\AddCartAction;
use Application\action\CartAction;

use Application\action\RemoveCartAction;
use Application\action\ValidateCart;
use Application\action\ViewProductAction;

use Application\action\ShopAction;

class Dispatcher
{
    private ?string $action = null;

    public function __construct(string $action)
    {
        $this->action = $action;
    }

    /**
     * @throws DatabaseConnectionException
     */
    final public function dispatch(): void
    {
        switch ($this->action) {
            case 'shop':
                $action = new ShopAction();
                $action->execute();
                break;
            case 'about-us':
                $action = new AboutAction();
                $action->execute();
                break;
            case 'compte':
                $act = new CompteAction();
                $act->execute();
                break;

            case 'view_product':
                $act = new ViewProductAction();
                $act->execute();
                break;
            case 'conn_log':
                $act = new LogConnAction();
                $act->execute();
                break;
            case 'login':
                $act = new LoginAction();
                $act->execute();
                break;
            case 'inscription':
                $act = new InscriptionAction();
                $act->execute();
                break;
            case 'cart':
                $act = new CartAction();
                $act->execute();
                break;
            case 'add_cart':
                $act = new AddCartAction();
                $act->execute();
                break;
            case 'remove_cart':
                $act = new RemoveCartAction();
                $act->execute();
                break;
            case 'checkout':
                $act = new ValidateCart();
                $act->execute();
                break;
            case 'add-star':
                $act = new AddStarAction();
                $act->execute();
                break;
            default:
                $act = new ActionAccueil();
                $act->execute();
                break;

        }

    }

}

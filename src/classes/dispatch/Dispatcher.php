<?php

declare(strict_types=1);

namespace Application\dispatch;

use Application\action\LoginAction;
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

            case 'view_product':
                $act = new ViewProductAction();
                $act->execute();
                break;
            case 'login':
                $act = new LoginAction();
                $act->execute();
                break;
            default:
                $html ='';
                break;
        }

    }
}

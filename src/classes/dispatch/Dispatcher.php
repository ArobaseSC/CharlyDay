<?php

declare(strict_types=1);

namespace Application\dispatch;

use Application\action\AddCartAction;
use Application\action\CartAction;
use Application\action\DefaultAction;

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
        $def = new DefaultAction();

        switch ($this->action) {

            case 'shop':
                $action = new ShopAction();
                $action->execute();
                break;

            case 'view_product':
                $act = new ViewProductAction();
                $act->execute();
                break;
            case 'cart':
                $act = new CartAction();
                $html = $act->execute();
                break;
            case 'add_cart':
                $act = new AddCartAction();
                $html = $act->execute();
                break;
            default:
                $html ='';
                break;
        }

        $this->render($def->header() . $html . $def->footer());
    }


    private function render(string $template): void
    {
        echo $template;
    }

}

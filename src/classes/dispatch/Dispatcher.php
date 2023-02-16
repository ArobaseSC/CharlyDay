<?php

declare(strict_types=1);

namespace Application\dispatch;

use Application\action\ActivationAction;
use Application\action\AddSeriesToPreferencesAction;
use Application\action\AjouterEpisodeAction;
use Application\action\AjouterSerieAction;
use Application\action\DisplaySerieAction;
use Application\action\DisplaySerieCommentairesAction;
use Application\action\DisplaySerieEnCours;
use Application\action\DisplaySerieEpisodeAction;
use Application\action\DisplayUserLikesAction;
use Application\action\DisplayViewedAction;
use Application\action\ProfileAction;
use Application\action\RemoveSeriesToPreferencesAction;
use Application\action\RenewAction;
use Application\action\RetirerSeriesAction;
use Application\action\SearchSeriesAction;
use Application\action\SigninAction;
use Application\action\SignupAction;
use Application\action\ViewCatalogueAction;
use Application\exception\datalayer\DatabaseConnectionException;

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

            default:

                $html ='';

                break;
        }

        $this->render($html);
    }


    private function render(string $template): void
    {

    }

}

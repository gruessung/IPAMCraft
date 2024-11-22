<?php

namespace App\Controller;

use App\Helpers\Alert;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends AbstractController
{
    /**
     * @var array $alerts
     */
    protected array $alerts = [];

    public function addAlert(Alert $alert) {
        $this->alerts[] = $alert;
    }

    public function render(string $view, array $parameters = [], Response $response = null): Response
    {
        $parameters['alerts'] = $this->alerts;
        return parent::render($view, $parameters, $response);
    }

}
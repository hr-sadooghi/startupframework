<?php
namespace App\Routes;

use Phroute\Phroute\RouteCollector;

class WebRouter
{
    public function __invoke(RouteCollector $routeCollector)
    {
        $routeCollector->get('dashboard', ['App\Controllers\PanelController','indexAction']);
        $routeCollector->get('login', ['App\Controllers\PanelController','loginAction']);
        return ;
    }
}

<?php

namespace App;

use App\Routes\WebRouter;
use App\ServiceProvider\ConfigServiceProvider;
use App\ServiceProvider\DatabaseServiceProvider;
use App\ServiceProvider\DispatcherServiceProvider;
use App\ServiceProvider\RouteCollectorServiceProvider;
use App\ServiceProvider\RouteResolverServiceProvider;
use App\ServiceProvider\TemplateServiceProvider;
use Phroute\Phroute\Dispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use League\Container\Container;

class HttpKernel
{
    protected $config;

    protected $container;

    /**
     * @param Request $request
     * @return Response
     */
    public function handleRequest(Request $request)
    {
        //init service container
        $this->container = new Container;

        $this->container->addServiceProvider(new ConfigServiceProvider());

        $this->container->addServiceProvider(new DatabaseServiceProvider());
        $this->container->addServiceProvider(new RouteCollectorServiceProvider());
        $this->container->addServiceProvider(new RouteResolverServiceProvider());
        $this->container->addServiceProvider(new DispatcherServiceProvider());
        $this->container->addServiceProvider(new TemplateServiceProvider());

        $routeCollector = $this->container->get('route.collector');

        $route = new WebRouter();
        $route->__invoke($routeCollector);

        /** @var Dispatcher $dispatcher */
        $dispatcher = $this->container->get('dispatcher');

        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = substr($url, strlen($this->container->get('config')['app']['base.url']));
        $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

        return new Response($response);
    }

    public function terminate(Request $request, Response $response)
    {

    }

}
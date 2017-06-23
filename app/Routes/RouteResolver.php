<?php
/**
 * Created by PhpStorm.
 * User: hamid
 * Date: 6/23/2017 AD
 * Time: 13:53
 */

namespace App\Routes;

use League\Container\ContainerInterface;
use Phroute\Phroute\HandlerResolverInterface;

class RouteResolver implements HandlerResolverInterface
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function resolve($handler)
    {
        /*
         * Only attempt resolve uninstantiated objects which will be in the form:
         *
         *      $handler = ['App\Controllers\Home', 'method'];
         */
        if(is_array($handler) and is_string($handler[0]))
        {
            $handler[0] = new $handler[0]($this->container);
//            $handler[0] = $this->container->get($handler[0]);
        }
//        var_dump($handler);

        return $handler;
    }
}
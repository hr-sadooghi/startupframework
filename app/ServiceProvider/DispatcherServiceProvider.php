<?php
/**
 * Created by PhpStorm.
 * User: hamid
 * Date: 6/22/2017 AD
 * Time: 16:47
 */

namespace App\ServiceProvider;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Phroute\Phroute\HandlerResolverInterface;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

class DispatcherServiceProvider extends AbstractServiceProvider
{
    /**
     * The provides array is a way to let the container
     * know that a service is provided by this service
     * provider. Every service that is registered via
     * this service provider must have an alias added
     * to this array or it will be ignored.
     *
     * @var array
     */
    protected $provides = [
        'dispatcher'
    ];

    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     *
     * @return void
     */
    public function register()
    {
        $this->container->share('dispatcher', function () {
            return new Dispatcher(
                $this->container->get('route.collector')->getData(),
                $this->container->get('route.resolver'));
        });
    }
}
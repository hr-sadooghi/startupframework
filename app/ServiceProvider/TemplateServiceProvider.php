<?php
/**
 * Created by PhpStorm.
 * User: hamid
 * Date: 6/22/2017 AD
 * Time: 16:47
 */

namespace App\ServiceProvider;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Twig_Environment;
use Twig_Loader_Filesystem;

class TemplateServiceProvider extends AbstractServiceProvider
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
        'template'
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
        $container = $this->getContainer();
        $config = $container->get('config');

        $container->share('template', function() use($config){

            $viewPath = BASE_PATH . $config['template']['views'];

            $cachePath = BASE_PATH . $config['template']['cache'];

            $loader = new Twig_Loader_Filesystem($viewPath);

            $engine = new Twig_Environment($loader, array(
                'cache' => $cachePath,
            ));

            return $engine;
        });
    }
}
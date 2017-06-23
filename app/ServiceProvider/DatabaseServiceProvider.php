<?php
/**
 * Created by PhpStorm.
 * User: hamid
 * Date: 6/22/2017 AD
 * Time: 16:47
 */

namespace App\ServiceProvider;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use League\Container\ServiceProvider\AbstractServiceProvider;

class DatabaseServiceProvider extends AbstractServiceProvider
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
        'dbal'
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
        $this->getContainer()->share('dbal', function() {
            $config = new Configuration();

            $connectionParams = array(
                'dbname' => 'test',
                'user' => 'root',
                'password' => '123',
                'host' => 'localhost',
                'driver' => 'pdo_mysql',
            );
            return DriverManager::getConnection($connectionParams, $config);
        });
    }
}
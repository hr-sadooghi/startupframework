<?php
/**
 * Created by PhpStorm.
 * User: hamid
 * Date: 6/23/2017 AD
 * Time: 05:20
 */

namespace App\Controllers;


use League\Container\ContainerInterface;

class PanelController
{
    protected $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function indexAction()
    {
        return $this->container->get('template')->render('panel.php');
        /** @var \Doctrine\DBAL\Connection $dbal */
//        $dbal = $this->container->get('dbal');

//        $r = $dbal->fetchAll("SELECT * FROM users");
    }

    public function loginAction()
    {
        /** @var \Twig_Environment $twig */
//        $twig = $this->container->get('template');
//        return $twig->render('panel.php')
        return $this->container->get('template')->render('login.php');

    }

}
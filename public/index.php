<?php
/**
 * Created by PhpStorm.
 * User: hamid
 * Date: 6/22/2017 AD
 * Time: 15:51
 */

require_once __DIR__ . '/../bootstrap.php';

use App\HttpKernel;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$kernel = new HttpKernel();

$response = $kernel->handleRequest($request);

$response->send();

$kernel->terminate($request, $response);
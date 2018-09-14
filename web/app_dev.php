<?php

use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

if (strpos($_SERVER['SERVER_NAME'], '.lc') === false || PHP_SAPI === 'cli-server') {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}


require __DIR__.'/../vendor/autoload.php';
Debug::enable();

$kernel = new AppKernel('dev', true);
if (PHP_VERSION_ID < 70000) {
    $kernel->loadClassCache();
}
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);

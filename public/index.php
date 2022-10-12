<?php

use App\Sdk\Endpoint\GetTest;

require '../vendor/autoload.php';

if ($_SERVER['REQUEST_URI'] === '/toto')
{
    $client = \App\Sdk\Client::create();
    $client->executeEndpoint(new GetTest(),'response');
}

if ($_SERVER['REQUEST_URI'] === '/test')
{
    return new \GuzzleHttp\Psr7\Response();
}
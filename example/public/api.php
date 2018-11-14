<?php

$loader = require __DIR__ . '/../../vendor/autoload.php';
// adding namespace, usually done in composer.json
$loader->setPsr4("Example\\", __DIR__ . "/../src");

$config = require "../config/main.php";

Tebe\Adroit\Application::instance()
    ->setConfig($config)
    /*->setMiddlewares([
        Relay\Middleware\ResponseSender::class
    ])*/
    ->setRoutes([
        ['GET', '/blog', Example\Ui\Api\Blog\BlogIndexAction::class],
        ['GET', '/blog/{id:[a-z0-9-]+}', Example\Ui\Api\Blog\BlogDetailAction::class],
        ['GET', '/*', Example\Ui\Api\ErrorAction::class], // TODO how to catch all other api calls?
    ])
    ->run();

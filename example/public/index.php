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
        ['GET', '/', Example\Ui\Web\IndexAction::class],
        ['GET', '/blog', Example\Ui\Web\Blog\BlogIndexAction::class],
        ['GET', '/blog/add', Example\Ui\Web\Blog\BlogAddAction::class],
        ['GET', '/blog/{id:[a-z0-9-]+}', Example\Ui\Web\Blog\BlogDetailAction::class],
        ['POST', '/blog/create', Example\Ui\Web\Blog\BlogCreateAction::class],
        ['GET', '/blog/{id:[a-z0-9-]+}/delete', Example\Ui\Web\Blog\BlogDeleteAction::class]
    ])
    ->run();

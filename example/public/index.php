<?php

require __DIR__ . '/../../vendor/autoload.php';

$config = require "../config/main.php";

Tebe\Adr\Application::instance()
    ->setConfig($config)
    /*->setMiddlewares([
        Relay\Middleware\ResponseSender::class,
        Equip\Handler\ExceptionHandler::class,
        Equip\Handler\DispatchHandler::class,
        Equip\Handler\JsonContentHandler::class,
        Equip\Handler\FormContentHandler::class,
        Equip\Handler\ActionHandler::class,
    ])*/
    ->setRoutes([
        ['GET', '/', \Tebe\AdrExample\Ui\Web\IndexAction::class],
        ['GET', '/blog', \Tebe\AdrExample\Ui\Web\Blog\BlogIndexAction::class],
        ['GET', '/blog/add', \Tebe\AdrExample\Ui\Web\Blog\BlogAddAction::class],
        ['GET', '/blog/{id:[a-z0-9-]+}', \Tebe\AdrExample\Ui\Web\Blog\BlogDetailAction::class],
        ['POST', '/blog/create', \Tebe\AdrExample\Ui\Web\Blog\BlogCreateAction::class],
        ['GET', '/blog/{id:[a-z0-9-]+}/delete', \Tebe\AdrExample\Ui\Web\Blog\BlogDeleteAction::class]
    ])
    ->run();

<?php

require __DIR__ . '/../../vendor/autoload.php';

$config = require "../config/main.php";

Tebe\Adroit\Application::instance()
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
        ['GET', '/', \Tebe\AdroitExample\Ui\Web\IndexAction::class],
        ['GET', '/blog', \Tebe\AdroitExample\Ui\Web\Blog\BlogIndexAction::class],
        ['GET', '/blog/add', \Tebe\AdroitExample\Ui\Web\Blog\BlogAddAction::class],
        ['GET', '/blog/{id:[a-z0-9-]+}', \Tebe\AdroitExample\Ui\Web\Blog\BlogDetailAction::class],
        ['POST', '/blog/create', \Tebe\AdroitExample\Ui\Web\Blog\BlogCreateAction::class],
        ['GET', '/blog/{id:[a-z0-9-]+}/delete', \Tebe\AdroitExample\Ui\Web\Blog\BlogDeleteAction::class]
    ])
    ->run();

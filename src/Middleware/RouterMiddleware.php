<?php

declare(strict_types=1);

namespace Tebe\Adroit\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Tebe\Pvc\Dispatcher;
use Tebe\Pvc\Router;

class RouterMiddleware implements MiddlewareInterface
{
    /**
     * @var Router
     */
    private $router;

    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * RouterMiddleware constructor.
     * @param Router $router
     * @param Dispatcher $dispatcher
     */
    public function __construct(Router $router, Dispatcher $dispatcher)
    {
        $this->router = $router;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $serverParams = $request->getServerParams();
        $pathInfo = $serverParams['PATH_INFO'] ?? '';
        $route = $this->router->match($pathInfo);
        $html = $this->dispatcher->dispatch($route);
        $response = $handler->handle($request);
        $response->getBody()->write($html);
        return $response;
    }
}

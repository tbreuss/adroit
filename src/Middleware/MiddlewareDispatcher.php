<?php

declare(strict_types=1);

namespace Tebe\Adroit\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MiddlewareDispatcher implements RequestHandlerInterface
{
    /**
     * @var MiddlewareInterface[]
     */
    protected $middlewares;

    /**
     * @var callable
     */
    private $default;

    /**
     * Dispatcher constructor.
     *
     * @param MiddlewareInterface[] $middlewares
     * @param callable $default
     */
    public function __construct(array $middlewares, callable $default)
    {
        $this->middlewares = $middlewares;
        $this->default = $default;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $middleware = array_shift($this->middlewares);

        // It there's no middleware use the default callable
        if ($middleware === null) {
            return call_user_func($this->default, $request);
        }

        return $middleware->process($request, $this);
    }
}

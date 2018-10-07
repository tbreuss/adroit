<?php

declare(strict_types=1);

namespace Tebe\Adroit;

use DI\Container;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Tebe\Adroit\Middleware\MiddlewareDispatcher;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Server;
use Zend\Diactoros\ServerRequestFactory;

class Application
{
    /**
     * @var Container;
     */
    private $container;

    /**
     * @var Application
     */
    private static $instance;

    /**
     * @var array
     */
    private $middlewares = [];

    /**
     * @var array
     */
    private $routes = [];

    /**
     * Application constructor.
     */
    private function __construct()
    {
        $this->container = new Container();
    }

    /**
     * @return Application
     * @throws Exception
     */
    public static function instance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     *
     */
    private function init()
    {
        $request = ServerRequestFactory::fromGlobals(
            $_SERVER,
            $_GET,
            $_POST,
            $_COOKIE,
            $_FILES
        );

        $response = new HtmlResponse('');

        $appPath = $this->getConfig()->get('appPath');

        $this->container->set('Psr\Http\Message\ServerRequestInterface', $request);
        $this->container->set('Psr\Http\Message\ResponseInterface', $response);
        $this->container->set('Tebe\Adroit\View', new View($appPath . '/resources/templates'));
        $this->container->set('Tebe\Adroit\Layout', new View($appPath . '/resources/layouts'));
    }

    /**
     * Run
     */
    public function run(): void
    {
        $this->init();

        $routing = $this->routes;

        $dispatcher = SimpleDispatcher(function (RouteCollector $r) use ($routing) {
            foreach ($routing as $route) {
                $r->addRoute($route[0], $route[1], $route[2]);
            }
        });

        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = isset($_SERVER['PATH_INFO']) ? rtrim($_SERVER['PATH_INFO'], '/') : '/';

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                header("HTTP/1.0 404 Not Found");
                $body = '';
                break;
            case Dispatcher::FOUND:

                $handler = $routeInfo[1];

                $obj = $this->container->get($handler);

                /*
                // Thanks to DI
                // Inject object into constructor
                $constructorParams = [];
                $reflectionClass = new \ReflectionClass($handler);
                if ($reflectionClass->hasMethod('__construct')) {
                    $reflectionMethod = $reflectionClass->getConstructor();
                    $reflectionParameters = $reflectionMethod->getParameters();
                    foreach ($reflectionParameters as $reflectionParameter) {
                        $type = $reflectionParameter->getType()->getName();
                        if ($type == 'Psr\Http\Message\ServerRequestInterface') {
                            $constructorParams[] = $this->getRequest();
                        }
                        if ($type == 'Tebe\\Adroit\\View') {
                            $constructorParams[] = $this->getView();
                        }
                    }
                }

                $obj = new $handler(...$constructorParams);
                */

                $method = method_exists($obj, 'execute') ? 'execute' : '__invoke';

                // Inject GET-params into action
                $requestParams = [];
                if (!empty($routeInfo[2])) {
                    $requestParams = $routeInfo[2];
                }
                $reflectionMethod = new \ReflectionMethod($obj, $method);
                $reflectionParameters = $reflectionMethod->getParameters();
                $request = $this->getRequest();
                foreach ($reflectionParameters as $reflectionParameter) {
                    $name = $reflectionParameter->getName();
                    $queryParams = $request->getQueryParams();
                    if (isset($queryParams[$name])) {
                        $requestParams[$name] = $queryParams[$name];
                    }
                }

                $body = call_user_func_array([$obj, $method], $requestParams);

                break;
            default:
                $body = '';
        }

        if ($body instanceof ResponseInterface) {

            $this->emit($body);

        } else {

            $html = $this->getLayout()->render('default', [
                'content' => $body
            ]);

            echo $html;

        }

        /*
        $middlewares = array_merge(
            $this->middlewares
            //[new RouterMiddleware($this->getRouter(), $this->getDispatcher())]
        );

        $middlewareDispatcher = new MiddlewareDispatcher(
            $middlewares,
            function () {
                return new HtmlResponse('', 200);
            }
        );

        $request = $this->getRequest();
        $response = $middlewareDispatcher->handle($request);

        $this->emit($response);
        */

    }

    /**
     * @param ResponseInterface $response
     */
    private function emit(ResponseInterface $response)
    {
        $statusCode = $response->getStatusCode();

        http_response_code($statusCode);

        foreach ($response->getHeaders() as $k => $values) {
            foreach ($values as $v) {
                header(sprintf('%s: %s', $k, $v), false);
            }
        }

        echo $response->getBody();
    }

    /**
     * @param array $config
     * @return Application
     */
    public function setConfig(array $config)
    {
        $this->container->set('Tebe\Adroit\Config', new Config($config));
        return $this;
    }

    /**
     * @param array $middlewares
     * @return Application
     */
    public function setMiddlewares(array $middlewares)
    {
        $this->middlewares = $middlewares;
        return $this;
    }

    /**
     * @param array $routes
     * @return Application
     */
    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
        return $this;
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->container->get('Tebe\Adroit\Config');
    }

    /**
     * @return View
     */
    public function getView()
    {
        return $this->container->get('Tebe\Adroit\View');
    }

    /**
     * @return View
     */
    public function getLayout()
    {
        return $this->container->get('Tebe\Adroit\Layout');
    }

    /**
     * @return ServerRequestInterface
     */
    public function getRequest()
    {
        return $this->container->get('Psr\Http\Message\ServerRequestInterface');
    }

}

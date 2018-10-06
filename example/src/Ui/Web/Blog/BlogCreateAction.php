<?php

namespace Tebe\AdrExample\Ui\Web\Blog;

use Psr\Http\Message\ServerRequestInterface;
use Tebe\Adr\Action;
use Tebe\Adr\Responder\RedirectResponder;
use Tebe\AdrExample\Domain\Blog\BlogService;

class BlogCreateAction extends Action
{
    private $request;
    private $service;
    private $responder;

    public function __construct(ServerRequestInterface $request, BlogService $service, RedirectResponder $responder)
    {
        $this->request = $request;
        $this->service = $service;
        $this->responder = $responder;
    }

    public function execute()
    {
        // not needed here
        /*
        $method = $this->request->getMethod();
        if ($method !== 'POST') {
            throw HttpException::methodNotAllowed(__CLASS__, $method, []);
        }
        */

        $data = $this->request->getParsedBody();
        $this->service->createItem($data);
        $response = $this->responder->response('/blog');

        return $response;
    }
}

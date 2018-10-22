<?php

namespace Example\Ui\Web\Blog;

use Example\Domain\Blog\BlogService;
use Psr\Http\Message\ServerRequestInterface;
use Tebe\Adroit\Action;
use Tebe\Adroit\Responder\RedirectResponder;

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

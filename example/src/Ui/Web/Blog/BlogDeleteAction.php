<?php

namespace Example\Ui\Web\Blog;

use Example\Domain\Blog\BlogService;
use Tebe\Adroit\Responder\RedirectResponder;

class BlogDeleteAction
{
    private $responder;
    private $service;

    public function __construct(BlogService $service, RedirectResponder $responder)
    {
        $this->responder = $responder;
        $this->service = $service;
    }

    public function execute(int $id)
    {
        $this->service->deleteItem($id);
        $response = $this->responder->response('/blog');
        return $response;
    }
}

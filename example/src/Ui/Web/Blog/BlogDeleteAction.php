<?php

namespace Tebe\AdrExample\Ui\Web\Blog;

use Tebe\Adr\Responder\RedirectResponder;
use Tebe\AdrExample\Domain\Blog\BlogService;

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

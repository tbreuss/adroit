<?php

namespace Tebe\AdrExample\Ui\Web\Blog;

use Tebe\Adr\Action;
use Tebe\Adr\Responder\HtmlResponder;
use Tebe\AdrExample\Domain\Blog\BlogService;

class BlogDetailAction extends Action
{
    private $service;
    private $responder;

    public function __construct(BlogService $service, HtmlResponder $responder)
    {
        $this->service = $service;
        $this->responder = $responder;
    }

    public function execute(string $id)
    {
        $item = $this->service->getItem($id);
        $response = $this->responder->response('blog/detail', [
            'item' => $item
        ]);
        return $response;
    }
}

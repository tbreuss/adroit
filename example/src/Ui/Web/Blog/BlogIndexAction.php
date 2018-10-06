<?php

namespace Tebe\AdrExample\Ui\Web\Blog;

use Tebe\Adr\Responder\HtmlResponder;
use Tebe\AdrExample\Domain\Blog\BlogService;

class BlogIndexAction
{
    private $service;
    private $responder;

    public function __construct(BlogService $service, HtmlResponder $responder)
    {
        $this->service = $service;
        $this->responder = $responder;
    }

    public function __invoke(string $sort = 'default', int $limit = 0)
    {
        $items = $this->service->getItems();
        $response = $this->responder->response('blog/index', [
            'items' => $items
        ]);
        return $response;
    }

}

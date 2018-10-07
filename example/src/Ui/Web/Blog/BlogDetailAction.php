<?php

namespace Tebe\AdroitExample\Ui\Web\Blog;

use Tebe\Adroit\Action;
use Tebe\Adroit\Responder\HtmlResponder;
use Tebe\AdroitExample\Domain\Blog\BlogService;

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

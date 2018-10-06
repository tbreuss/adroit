<?php

namespace Tebe\AdrExample\Ui\Web\Blog;

use Tebe\Adr\Action;
use Tebe\Adr\Responder\HtmlResponder;

class BlogAddAction extends Action
{
    private $responder;

    public function __construct(HtmlResponder $responder)
    {
        $this->responder = $responder;
    }

    public function execute()
    {
        $response = $this->responder->response('blog/add');
        return $response;
    }
}

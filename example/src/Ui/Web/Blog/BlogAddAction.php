<?php

namespace Tebe\AdroitExample\Ui\Web\Blog;

use Tebe\Adroit\Action;
use Tebe\Adroit\Responder\HtmlResponder;

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

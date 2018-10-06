<?php

namespace Tebe\AdrExample\Ui\Web;

use Tebe\Adr\Responder\HtmlResponder;

class IndexAction
{

    private $responder;

    public function __construct(HtmlResponder $responder)
    {
        $this->responder = $responder;
    }

    public function execute()
    {
        $response = $this->responder->response('index');
        return $response;
    }

}

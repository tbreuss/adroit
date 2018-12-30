<?php

namespace Example\Ui\Api;

use Tebe\Adroit\Responder\JsonResponder;

class ErrorAction
{

    private $responder;

    public function __construct(JsonResponder $responder)
    {
        $this->responder = $responder;
    }

    public function execute()
    {
        $response = $this->responder->response([
            'error' => 'not_found'
        ]);
        return $response;
    }

}

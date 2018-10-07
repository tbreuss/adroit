<?php

namespace Tebe\Adroit\Responder;

use Psr\Http\Message\ResponseInterface;

class RedirectResponder
{
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @inheritDoc
     */
    public function response(string $location)
    {
        /*
        $location = $payload->getSetting('redirect');
        if (!empty($location)) {
            $response = $this->response->withHeader('Location', $location);
        }
        */
        $response = $this->response->withHeader('Location', $location);
        return $response;
    }

}

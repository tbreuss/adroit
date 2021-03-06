<?php

declare(strict_types=1);

namespace Tebe\Adroit\Responder;

use Psr\Http\Message\ResponseInterface;

class RedirectResponder
{
    /** @var ResponseInterface */
    private $response;

    /**
     * RedirectResponder constructor.
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @param string $location
     * @return ResponseInterface
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

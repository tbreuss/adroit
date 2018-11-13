<?php

declare(strict_types=1);

namespace Tebe\Adroit\Responder;

use Psr\Http\Message\ResponseInterface;

class JsonResponder
{
    /** @var ResponseInterface */
    private $response;

    /**
     * JsonResponder constructor.
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @param array $params
     * @return ResponseInterface
     */
    public function response(array $params = [])
    {
        $json = json_encode($params);

        $response = $this->response->withHeader('Content-Type', 'application/json');
        $body = $response->getBody();
        $body->rewind();
        $body->write($json);

        return $response;
    }

}

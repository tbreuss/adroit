<?php

declare(strict_types=1);

namespace Tebe\Adroit\Responder;

use Psr\Http\Message\ResponseInterface;
use Tebe\Adroit\View;

class HtmlResponder
{
    private $response;

    public function __construct(ResponseInterface $response, View $view)
    {
        $this->response = $response;
        $this->view = $view;
    }

    /**
     * @inheritDoc
     */
    public function response(string $view, array $params = [])
    {
        /*
        $location = $payload->getSetting('redirect');
        if (!empty($location)) {
            $response = $this->response->withHeader('Location', $location);
        }
        */

        $content = $this->view->render($view, $params);

        $html = $this->view->render('layouts/default', [
            'content' => $content
        ]);

        $body = $this->response->getBody();
        $body->rewind();
        $body->write($html);

        return $this->response;
    }

}

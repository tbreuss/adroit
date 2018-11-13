<?php

declare(strict_types=1);

namespace Tebe\Adroit\Responder;

use Psr\Http\Message\ResponseInterface;
use Tebe\Adroit\View;

class HtmlResponder
{
    /** @var ResponseInterface */
    private $response;

    /**
     * HtmlResponder constructor.
     * @param ResponseInterface $response
     * @param View $view
     */
    public function __construct(ResponseInterface $response, View $view)
    {
        $this->response = $response;
        $this->view = $view;
    }

    /**
     * @param string $view
     * @param array $params
     * @return ResponseInterface
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

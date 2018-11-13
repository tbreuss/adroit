<?php

namespace Example\Ui\Api\Blog;

use Example\Domain\Blog\BlogService;
use Psr\Http\Message\ResponseInterface;
use Tebe\Adroit\Action;
use Tebe\Adroit\Responder\JsonResponder;

class BlogDetailAction extends Action
{
    /** @var BlogService */
    private $service;

    /** @var JsonResponder */
    private $responder;

    /**
     * BlogDetailAction constructor.
     * @param BlogService $service
     * @param JsonResponder $responder
     */
    public function __construct(BlogService $service, JsonResponder $responder)
    {
        $this->service = $service;
        $this->responder = $responder;
    }

    /**
     * @param string $id
     * @return ResponseInterface
     */
    public function execute(string $id)
    {
        $item = $this->service->getItem($id);
        $response = $this->responder->response($item);
        return $response;
    }
}

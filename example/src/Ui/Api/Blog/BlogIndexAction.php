<?php

namespace Example\Ui\Api\Blog;

use Example\Domain\Blog\BlogService;
use Psr\Http\Message\ResponseInterface;
use Tebe\Adroit\Responder\JsonResponder;

class BlogIndexAction
{
    /** @var BlogService */
    private $service;

    /** @var JsonResponder */
    private $responder;

    /**
     * BlogIndexAction constructor.
     * @param BlogService $service
     * @param JsonResponder $responder
     */
    public function __construct(BlogService $service, JsonResponder $responder)
    {
        $this->service = $service;
        $this->responder = $responder;
    }

    /**
     * @param string $sort
     * @param int $limit
     * @return ResponseInterface
     */
    public function __invoke(string $sort = 'default', int $limit = 0)
    {
        $items = $this->service->getItems();
        $response = $this->responder->response($items);
        return $response;
    }

}

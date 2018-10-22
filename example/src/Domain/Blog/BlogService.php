<?php

namespace Example\Domain\Blog;

class BlogService
{
    private $model;

    public function __construct(BlogModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function createItem(array $data)
    {
        if (empty($data['date'])) {
            $data['date'] = date('Y-m-d');
        }
        return $this->model->save($data);
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->model->findAll();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getItem(int $id)
    {
        return $this->model->findOne($id);
    }

    public function deleteItem(int $id)
    {
        return $this->model->delete($id);
    }

}

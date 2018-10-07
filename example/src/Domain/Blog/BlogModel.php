<?php

namespace Tebe\AdroitExample\Domain\Blog;

class BlogModel
{

    public function findAll()
    {
        $data = $this->readFromFile();
        return $data;
    }

    public function findOne(string $id)
    {
        $data = $this->readFromFile();
        foreach ($data as $d) {
            if ($d['id'] == $id) {
                return $d;
            }
        }
        return [];
    }

    public function save(array $item)
    {
        $data = $this->readFromFile();
        $ids = array_column($data, 'id');
        $item['id'] = max($ids)+1;
        $data[] = $item;
        $this->writeToFile($data);
        return true;
    }

    public function delete(string $id)
    {
        $data = $this->readFromFile();
        foreach ($data as $key=>$d) {
            if ($id == $d['id']) {
                unset($data[$key]);
                $this->writeToFile($data);
                return true;
            }
        }
        return false;
    }

    private function readFromFile()
    {
        $filepath = __DIR__ . '/data.json';
        $contents = file_get_contents($filepath);
        return json_decode($contents, true);
    }

    private function writeToFile(array $data)
    {
        $filepath = __DIR__ . '/data.json';
        $json = json_encode($data);
        return file_put_contents($filepath, $json);
    }

}

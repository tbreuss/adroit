<?php

declare(strict_types=1);

namespace Tebe\Adroit;

class Config
{
    /**
     * @var array
     */
    private $data;

    /**
     * Config constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Get value by using dot notation for nested arrays.
     *
     * @example $value = $this->get('foo.bar.baz');
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function get($name, $default = null)
    {
        $path = explode('.', $name);
        $current = $this->data;
        foreach ($path as $field) {
            if (isset($current) && isset($current[$field])) {
                $current = $current[$field];
            } elseif (is_array($current) && isset($current[$field])) {
                $current = $current[$field];
            } else {
                return $default;
            }
        }
        return $current;
    }
}

<?php

declare(strict_types=1);

namespace Tebe\Pvc\Helper;

class AssertHelper
{
    /**
     * @param string $input
     * @param string $message
     * @throws \Exception
     */
    public static function isDirectory(string $input, string $message = 'Directory %s does not exist')
    {
        if (!is_dir($input)) {
            throw new \Exception(
                sprintf($message, $input)
            );
        }
    }

    /**
     * @param string $input
     * @param string $message
     * @throws \Exception
     */
    public static function isFile(string $input, string $message = 'File %s does not exist')
    {
        if (!is_file($input)) {
            throw new \Exception(
                sprintf($message, $input)
            );
        }
    }

    /**
     * @param string $input
     * @param string $message
     * @throws \Exception
     */
    public static function classExists(string $input, string $message = 'Class %s does not exist')
    {
        if (!class_exists($input, false)) {
            throw new \Exception(
                sprintf($message, $input)
            );
        }
    }

    /**
     * @param string $class
     * @param string $method
     * @param string $message
     * @throws \Exception
     */
    public static function classMethodExists(string $class, string $method, string $message = 'Class method %s does not exist')
    {
        if (!method_exists($class, $method)) {
            throw new \Exception(
                sprintf($message, $method)
            );
        }
    }

    /**
     * @param array $input
     * @param string $message
     * @throws \Exception
     */
    public static function notEmptyArray(array $input, string $message = 'Array is empty')
    {
        if (count($input) === 0) {
            throw new \Exception(
                sprintf($message, $input)
            );
        }
    }
}

<?php

namespace Tebe\Adroit\Exception;

use RuntimeException;

class HttpException extends RuntimeException
{
    /**
     * @param string $path
     *
     * @return static
     */
    public static function notFound($path)
    {
        return new static(sprintf(
            'Cannot find any resource at `%s`',
            $path
        ), 404);
    }

    /**
     * @param string $path
     * @param string $method
     * @param array $allowed
     *
     * @return static
     */
    public static function methodNotAllowed($path, $method, array $allowed)
    {
        $error = new static(sprintf(
            'Cannot access resource `%s` using method `%s`',
            $path,
            $method
        ), 405);

        $error->allowed = $allowed;

        return $error;
    }

}

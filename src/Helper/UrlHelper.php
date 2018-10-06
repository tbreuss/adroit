<?php

declare(strict_types=1);

namespace Tebe\Adr\Helper;

// @todo implement class properly
class UrlHelper
{
    public static function to($url = '')
    {
        if (is_array($url)) {
            return static::toRoute($url);
        }
        return $url;
    }

    public static function toRoute(array $route): string
    {
        $urlParts = [$_SERVER['SCRIPT_NAME']];

        $r = trim(array_shift($route), '/');
        if (!empty($r)) {
            $urlParts[] = '/';
            $urlParts[] = $r;
        }

        $anchor = [];
        if (isset($route['#'])) {
            $anchor[] = '#';
            $anchor[] = $route['#'];
            unset($route['#']);
        }

        if (!empty($route)) {
            $query = http_build_query($route);
            $urlParts[] = '?';
            $urlParts[] = $query;
        }

        $urlParts = array_merge($urlParts, $anchor);

        $url = implode('', $urlParts);
        return $url;
    }
}

<?php

declare(strict_types=1);

namespace Tebe\Adroit\ViewHelper;

use Tebe\Adroit\Helper\UrlHelper;
use Tebe\Adroit\ViewHelper;

class UrlViewHelper implements ViewHelper
{
    public function execute(array $args = [])
    {
        if (empty($args[0])) {
            return '';
        }
        return UrlHelper::to($args[0]);
    }
}

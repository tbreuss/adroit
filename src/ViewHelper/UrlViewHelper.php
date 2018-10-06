<?php

declare(strict_types=1);

namespace Tebe\Adr\ViewHelper;

use Tebe\Adr\Helper\UrlHelper;
use Tebe\Adr\ViewHelper;

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

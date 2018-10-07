<?php

declare(strict_types=1);

namespace Tebe\Adroit\ViewHelper;

use Tebe\Adroit\ViewHelper;

class EscapeViewHelper implements ViewHelper
{
    public function execute(array $args = [])
    {
        return htmlspecialchars($args[0]);
    }
}

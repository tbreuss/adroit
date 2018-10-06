<?php

declare(strict_types=1);

namespace Tebe\Adr\ViewHelper;

use Tebe\Adr\ViewHelper;

class EscapeViewHelper implements ViewHelper
{
    public function execute(array $args = [])
    {
        return htmlspecialchars($args[0]);
    }
}

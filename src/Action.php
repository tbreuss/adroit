<?php

declare(strict_types=1);

namespace Tebe\Adroit;

abstract class Action
{
    public function __invoke()
    {
        $this->execute();
    }

}

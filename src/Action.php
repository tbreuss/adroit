<?php

namespace Tebe\Adroit;

abstract class Action
{
    public function __invoke()
    {
        $this->execute();
    }

}

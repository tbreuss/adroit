<?php

namespace Tebe\Adr;

abstract class Action
{
    public function __invoke()
    {
        $this->execute();
    }

}

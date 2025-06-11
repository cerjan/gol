<?php

declare(strict_types=1);

namespace App\Model;

class Life
{
    /**
     * @param World $world
     */
    public function __construct(
        private World $world,
    ) {
    }

    public function getWorld(): World
    {
        return $this->world;
    }
}

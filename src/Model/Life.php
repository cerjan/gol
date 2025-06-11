<?php

declare(strict_types=1);

namespace App\Model;

readonly class Life
{
    /**
     * @param World $world
     */
    public function __construct(
        public World $world,
    ) {
    }
}

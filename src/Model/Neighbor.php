<?php

declare(strict_types=1);

namespace App\Model;

readonly class Neighbor
{
    public function __construct(
        public int $xPos,
        public int $yPos,
    ) {
    }
}

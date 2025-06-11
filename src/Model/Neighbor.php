<?php

declare(strict_types=1);

namespace App\Model;

class Neighbor
{
    public function __construct(
        private int $xPos,
        private int $yPos,
    ) {
    }

    public function getXPos(): int
    {
        return $this->xPos;
    }

    public function getYPos(): int
    {
        return $this->yPos;
    }
}

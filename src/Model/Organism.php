<?php

declare(strict_types=1);

namespace App\Model;

class Organism
{
    public function __construct(
        private int $xPos,
        private int $yPos,
        private string $species
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

    public function getSpecies(): string
    {
        return $this->species;
    }
}

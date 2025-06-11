<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Serializer\Attribute\SerializedPath;

class World
{
    /**
     * @param list<Organism> $organisms
     */
    public function __construct(
        private int $cells,
        private int $species,
        private int $iterations,
        #[SerializedPath('[organisms][organism]')]
        private array $organisms,
    ) {
    }

    public function getCells(): int
    {
        return $this->cells;
    }

    public function getSpecies(): int
    {
        return $this->species;
    }

    public function getIterations(): int
    {
        return $this->iterations;
    }

    public function getOrganisms(): array
    {
        return $this->organisms;
    }
}

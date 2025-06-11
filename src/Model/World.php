<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Serializer\Attribute\SerializedPath;

readonly class World
{
    /**
     * @param int $cells
     * @param int $species
     * @param int $iterations
     * @param list<Organism> $organisms
     */
    public function __construct(
        public int $cells,
        public int $species,
        public int $iterations,
        #[SerializedPath('[organisms][organism]')]
        public array $organisms,
    ) {
    }
}

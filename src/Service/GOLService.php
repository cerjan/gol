<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Life;
use App\Model\Neighbor;
use App\Model\Organism;
use Symfony\Component\Serializer\SerializerInterface;

final class GOLService
{
    public readonly Life $life;

    /** @var array<int, array<int, Organism>> */
    private array $organisms = [];

    public function __construct(
        private readonly SerializerInterface $serializer,
        private int $time = 0,
    )
    {
        $this->life = $this->serializer->deserialize(file_get_contents(__DIR__ . '/../../var/tmp/data.xml'), Life::class, 'xml');

        for ($y = 0; $y <= $this->life->world->cells ; $y++) {
            for ($x = 0; $x <= $this->life->world->cells ; $x++) {
                $this->organisms[$x] ??= [];
                $this->organisms[$x][$y] ??= null;
            }
        }

        foreach ($this->life->world->organisms as $organism) {
            $this->saveToXY($organism->xPos, $organism->yPos, $organism);
        }
    }

    /**
     * @return list<Organism>|null
     */
    public function iterate(): ?array
    {
        if ($this->time++ <= $this->life->world->cells) {
            $newOrganism = $this->organisms;

            foreach ($this->organisms as $y => $row) {
                foreach ($row as $x => $organism) {
                    $newOrganism[$x][$y] = $organism;
                }
            }
        }

        return null;
    }

    /**
     * @param list<Organism> $organisms
     * @return list<Organism>
     */
    private function removeDuplicates(array $organisms): array
    {
        shuffle($organisms);
        $used = [];

        foreach ($organisms as $organism) {
            if (key_exists(self::getStringKey($organism), $used)) {
                continue;
            }
            $used[self::getStringKey($organism)] = $organism;
        }

        return $used;
    }

    private function sameSpecies(int $x, int $y, int $n, string $species): int
    {
        $spacies = 0;

        foreach ($this->getNeighbors($x, $y, $n) as $neighbor) {

        }
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $n
     * @return list<Neighbor>
     */
    public function getNeighbors(int $x, int $y, int $n): array
    {
        $neighbors = [];

        $dx = [-1, -1, -1, 0, 0, 1, 1, 1];
        $dy = [-1, 0, 1, -1, 1, -1, 0, 1];

        for ($i = 0; $i < count($dx); $i++) {
            $newX = $x + $dx[$i];
            $newY = $y + $dy[$i];

            if ($newX >= 0 && $newX < $n && $newY >= 0 && $newY < $n) {
                $neighbors[] = new Neighbor($newX, $newY);
            }
        }

        return $neighbors;
    }

    private function saveToXY(int $x, int $y, Organism $organism): void
    {
        $this->organisms[$x] ??= [];
        $this->organisms[$x][$y] ??= $organism;
    }

    private static function getStringKey(Organism $organism): string
    {
        return $organism->xPos . ':' . $organism->yPos;
    }

}

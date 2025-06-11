<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Life;
use App\Model\Neighbor;
use App\Model\Organism;
use Symfony\Component\Serializer\SerializerInterface;

final class GameOfLife
{
    /** @var array<int, array<int, Organism>> */
    private array $organisms = [];

    public function __construct(
        private readonly Life $life,
        private int $iterations = 0,
    )
    {
//        $this->life = $this->serializer->deserialize(file_get_contents(__DIR__ . '/../../var/tmp/data.xml'), Life::class, 'xml');
//
        for ($y = 0; $y <= $this->life->getWorld()->getCells() ; $y++) {
            for ($x = 0; $x <= $this->life->getWorld()->getCells() ; $x++) {
                $this->organisms[$y] ??= [];
                $this->organisms[$y][$x] = '-';
            }
        }

        echo implode('', array_map(fn($o) => 'a', $organism));
//
        foreach ($this->life->getWorld()->getOrganisms() as $organism) {
            $this->saveToXY($organism->getXPos(), $organism->getYPos(), $organism);
        }
    }

    /**
     * @return list<Organism>|null
     */
    public function iterate(): ?array
    {
        if ($this->iterations++ <= $this->life->getWorld()->getIterations()) {
            $newOrganism = $this->organisms;

            foreach ($this->organisms as $y => $row) {
                foreach ($row as $x => $organism) {
                    $newOrganism[$x][$y] = $organism;
                }
            }

            return  $newOrganism;
        }

        return null;
    }
//
//    /**
//     * @param list<Organism> $organisms
//     * @return list<Organism>
//     */
//    private function removeDuplicates(array $organisms): array
//    {
//        shuffle($organisms);
//        $used = [];
//
//        foreach ($organisms as $organism) {
//            if (key_exists(self::getStringKey($organism), $used)) {
//                continue;
//            }
//            $used[self::getStringKey($organism)] = $organism;
//        }
//
//        return $used;
//    }
//
//    private function sameSpecies(int $x, int $y, int $n, string $species): int
//    {
//        $spacies = 0;
//
//        foreach ($this->getNeighbors($x, $y, $n) as $neighbor) {
//
//        }
//    }
//
//    /**
//     * @param int $x
//     * @param int $y
//     * @param int $n
//     * @return list<Neighbor>
//     */
//    public function getNeighbors(int $x, int $y, int $n): array
//    {
//        $neighbors = [];
//
//        $dx = [-1, -1, -1, 0, 0, 1, 1, 1];
//        $dy = [-1, 0, 1, -1, 1, -1, 0, 1];
//
//        for ($i = 0; $i < count($dx); $i++) {
//            $newX = $x + $dx[$i];
//            $newY = $y + $dy[$i];
//
//            if ($newX >= 0 && $newX < $n && $newY >= 0 && $newY < $n) {
//                $neighbors[] = new Neighbor($newX, $newY);
//            }
//        }
//
//        return $neighbors;
//    }
//
    private function saveToXY(int $x, int $y, Organism $organism): void
    {
        $this->organisms[$x][$y] = $organism;
    }
//
//    private static function getStringKey(Organism $organism): string
//    {
//        return $organism->xPos . ':' . $organism->yPos;
//    }

}

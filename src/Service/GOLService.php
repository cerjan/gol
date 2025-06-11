<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Life;
use Symfony\Component\Serializer\SerializerInterface;

final readonly class GOLService
{
    public function __construct(
        SerializerInterface $serializer,
    ) {
        /** @var Life $life */
        $life = $serializer->deserialize(file_get_contents(__DIR__ . '/../data.xml'), Life::class, 'xml');

        dump($life);
    }
}

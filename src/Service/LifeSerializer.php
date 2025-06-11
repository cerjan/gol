<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Life;
use InvalidArgumentException;
use Symfony\Component\Serializer\SerializerInterface;

readonly class LifeSerializer
{
    public function __construct(
        private SerializerInterface $serializer,
    ) {
    }

    public function deserializeFromXmlContent(string $xmlContent): Life
    {
        if ($xmlContent === '') {
            throw new InvalidArgumentException('Blank xml content');
        }

        return $this->serializer->deserialize($xmlContent, Life::class, 'xml');
    }
}

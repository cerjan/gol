<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Model\Life;
use App\Model\Organism;
use App\Model\World;
use App\Service\LifeSerializer;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class LifeSerializerTest extends KernelTestCase
{
    private LifeSerializer $lifeSerializer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->lifeSerializer = self::getContainer()->get(LifeSerializer::class);
    }

    public function testDeserializeFromXmlContent()
    {
        $life = $this->lifeSerializer->deserializeFromXmlContent(file_get_contents(__DIR__ . '/fixture-valid.xml'));

        self::assertEquals(new Life(
            new World(
                10,
                200,
                10,
                [
                    new Organism(13, 18, 'h'),
                    new Organism(7, 19, 'x'),
                ]
            )
        ), $life);
    }

    public function testDeserializeFromXmlContentInvalid(): void
    {
        $this->expectException(ExceptionInterface::class);

        $this->lifeSerializer->deserializeFromXmlContent(file_get_contents(__DIR__ . '/fixture-invalid.xml'));
    }

    public function testDeserializeFromXmlContentBlank(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Blank xml content');

        $this->lifeSerializer->deserializeFromXmlContent('');
    }
}

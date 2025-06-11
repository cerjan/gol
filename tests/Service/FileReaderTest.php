<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\FileReader;
use Generator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class FileReaderTest extends TestCase
{
    private FileReader $fileReader;

    protected function setUp(): void
    {
        parent::setUp();

        $this->fileReader = new FileReader();
    }

    public function testGetContent()
    {
        $testPath = __DIR__ . '/fixture-valid.xml';

        $content = $this->fileReader->getContent($testPath);

        self::assertEquals(file_get_contents($testPath), $content);
    }

    public function testGetContentNotExists()
    {
        $testPath = __DIR__ . '/fixture-not-exist.xml';

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf('File path `%s` does not exist', $testPath));

        $this->fileReader->getContent($testPath);
    }
}

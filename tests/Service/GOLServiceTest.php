<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\GOLService;
use PHPUnit\Framework\TestCase;

class GOLServiceTest extends TestCase
{
    private GOLService $golService;

    protected function setUp(): void
    {
        $this->golService = new GOLService();
        parent::setUp();
    }

    public function testGetNeighbors()
    {

    }

    public function dataProvider(): \Generator
    {
        yield [];
    }
}

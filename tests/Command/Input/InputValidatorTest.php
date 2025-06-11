<?php

declare(strict_types=1);

namespace App\Tests\Command\Input;

use App\Command\Input\InputValidator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;

class InputValidatorTest extends TestCase
{

    private InputValidator $inputValidator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->inputValidator = new InputValidator(__DIR__);
    }

    public function testValidate(): void
    {
        $actual = $this->inputValidator->validate(self::getArrayInput('fixture-exists.xml'));

        self::assertEquals(__DIR__ . '/fixture-exists.xml', $actual);
    }

    public function testValidateNotExists(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("File `fixture-not-exists.xml` does not exist");

        $this->inputValidator->validate(self::getArrayInput('fixture-not-exists.xml'));
    }

    public function testValidateBlank(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("File name is empty");

        $this->inputValidator->validate(self::getArrayInput(''));
    }

    private static function getArrayInput(string $file): InputInterface
    {
        return new ArrayInput([
            'inputFile' => $file,
        ], new InputDefinition([
            new InputArgument('inputFile', InputArgument::REQUIRED),
        ]));
    }
}

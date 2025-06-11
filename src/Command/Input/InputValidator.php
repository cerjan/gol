<?php

declare(strict_types=1);

namespace App\Command\Input;

use Symfony\Component\Console\Input\InputInterface;

class InputValidator
{
    public function __construct(
        private string $tmpDir,
    )
    {
    }

    public function validateInputFile(InputInterface $input): string
    {
        $file = $input->getArgument('inputFile');

        if ($file === '') {
            throw new \InvalidArgumentException('File name is empty');
        }

        if (!file_exists($this->tmpDir . '/' . $file)) {
            throw new \InvalidArgumentException("File `{$file}` does not exist");
        }

        return $this->tmpDir . '/' . $file;
    }
}

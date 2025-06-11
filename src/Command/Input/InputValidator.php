<?php

declare(strict_types=1);

namespace App\Command\Input;

class InputValidator
{
    public function __construct(
        private string $tmpDir,
    )
    {
    }

    public function validate(string $file): string
    {
        if ($file === '') {
            throw new \InvalidArgumentException('File is empty');
        }

        if (!file_exists($this->tmpDir . '/' . $file)) {
            throw new \InvalidArgumentException("File `{$file}` does not exist");
        }

        return $this->tmpDir . '/' . $file;
    }
}

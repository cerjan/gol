<?php

declare(strict_types=1);

namespace App\Service;

use InvalidArgumentException;
use RuntimeException;

class FileReader
{
    public function getContent(string $filePath): string
    {
        if ($filePath === '') {
            throw new InvalidArgumentException('File path is empty');
        }

        if (file_exists($filePath) === false) {
            throw new InvalidArgumentException(sprintf('File path `%s` does not exist', $filePath));
        }

        $content = file_get_contents($filePath);

        if ($content === false) {
            throw new RuntimeException(sprintf('Unable to read file `%s`', $filePath));
        }

        return $content;
    }
}

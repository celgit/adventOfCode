<?php

declare(strict_types=1);

namespace Christofer\Adventofcode2022;

use PHPUnit\Exception;

class App
{

    private string $fileName;
    private $handle;

    /**
     * @throws \Exception
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
        $this->fileExists();
        $this->openFile();
    }

    final public function getFileContentsAsList(): array
    {
        $result = [];

        $contents = fread($this->handle, filesize($this->fileName));
        $blocks = explode("\n\n", $contents);

        foreach ($blocks as $block) {
            $result[] = explode("\n", $block);
        }

        return $result;
    }

    final public function getBiggestBlockSum(): int
    {
        $list = $this->getFileContentsAsList();
        $biggest = 0;
        foreach ($list as $elf) {
            $elfsum = array_sum($elf);
            if ($elfsum > $biggest) {
                $biggest = $elfsum;
            }
        }

        return $biggest;
    }

    private function openFile(): void
    {
        $this->handle = fopen($this->fileName, 'rb');
    }

    /**
     * @throws \Exception
     */
    private function fileExists(): void
    {
        if (!file_exists($this->fileName)) {
            throw new \Exception();
        }
    }


}


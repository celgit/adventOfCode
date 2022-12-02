<?php

declare(strict_types=1);

namespace Christofer\Adventofcode2022;


use Exception;

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

    public function getFileContentsAsList(): array
    {
        $result = [];

        $contents = fread($this->handle, filesize($this->fileName));
        $blocks = explode("\n\n", $contents);

        foreach ($blocks as $block) {
            $result[] = explode("\n", $block);
        }

        return $result;
    }

    public function getBiggestBlockSum(): int
    {
        $list = $this->getFileContentsAsList();
        $highestSumSoFar = 0;
        foreach ($list as $elf) {
            $sumPerElf = array_sum($elf);
            if ($sumPerElf > $highestSumSoFar) {
                $highestSumSoFar = $sumPerElf;
            }
        }

        return $highestSumSoFar;
    }

    private function openFile(): void
    {
        $this->handle = fopen($this->fileName, 'rb');
    }

    /**
     * @throws Exception
     */
    private function fileExists(): void
    {
        if (!file_exists($this->fileName)) {
            throw new Exception();
        }
    }

    public function getAllResults(): array
    {
        $list = $this->getFileContentsAsList();
        $resultList = [];

        foreach ($list as $elf) {
            $resultList[] = array_sum($elf);
        }

        return $resultList;
    }

    public function getAllResultsSortedDescending(): array
    {
        $resultList = $this->getAllResults();
        rsort($resultList);

        return $resultList;
    }
}


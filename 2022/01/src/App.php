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

    public function getTopXResults(int $numberOfResults): array
    {
        $resultList = $this->getAllResultsSortedDescending();

        return array_slice($resultList, 0, $numberOfResults);
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
}


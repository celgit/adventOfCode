<?php

declare(strict_types=1);

use Christofer\Adventofcode2022\App;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertSame;

class AppTest extends TestCase
{

    final public function testCalcKcalSumOfArray(): void
    {
        $num1 = 111;
        $num2 = 222;
        $num3 = 333;

        $arrayOfNum = [$num1, $num2, $num3];

        $fileName = __DIR__.'/testFile.csv';
        $app = new App($fileName);

        self::assertSame(666, $app->calcKcalSum($arrayOfNum));
    }

    final public function testFileNotEmpty(): void
    {
        $fileName = __DIR__.'/testFile.csv';
        $app = new App($fileName);

        self::assertNotEmpty($app->readFile());
    }

    final public function testFileDoesNotExist(): void
    {
        $fileName = __DIR__.'/testFileThatDoesNotExist.csv';

        self::expectException(Exception::class);

        $app = new App($fileName);

    }

    final public function testReturnsCorrectNumberOfItems(): void
    {
        $fileName = __DIR__.'/testFile.csv';

        $app = new App($fileName);
        self::assertCount(2, $app->getFileContentsAsList());

    }

    final public function testGetContents(): void
    {
        $fileName = __DIR__.'/testFile.csv';
        $expectedContent = [
            ['234', '432', '235'],
            [ '3423', '5453', '4334'],
        ];

        $app = new App($fileName);
        self::assertSame($expectedContent, $app->getFileContentsAsList());
    }

    final public function testItWillFindBiggestBlockSum(): void
    {
        $fileName = __DIR__.'/testFile.csv';

        $app = new App($fileName);
        self::assertSame(13210, $app->getBiggestBlockSum());
    }

    final public function testItWillFindBiggestBlockSumFromRealFile(): void
    {
        $fileName = __DIR__.'/input.csv';

        $app = new App($fileName);
        self::assertSame(68467, $app->getBiggestBlockSum());
    }
}

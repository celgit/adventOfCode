<?php

declare(strict_types=1);

use Christofer\Adventofcode2022\App;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertSame;

class AppTest extends TestCase
{
    const TEST_FILE_ONE = __DIR__ . '/testFile.csv';
    const TEST_FILE_TWO = __DIR__ . '/testFile2.csv';
    const REAL_FILE = __DIR__ . '/../../../01/data/input.csv';

    public function testFileDoesNotExist(): void
    {
        $fileName = __DIR__.'/testFileThatDoesNotExist.csv';

        $this->expectException(Exception::class);

        new App($fileName);
    }

    public function testReturnsCorrectNumberOfItems(): void
    {
        $fileName = self::TEST_FILE_ONE;

        $app = new App($fileName);
        self::assertCount(2, $app->getFileContentsAsList());

    }

    public function testGetContents(): void
    {
        $fileName = self::TEST_FILE_ONE;
        $expectedContent = [
            ['234', '432', '235'],
            [ '3423', '5453', '4334'],
        ];

        $app = new App($fileName);
        self::assertSame($expectedContent, $app->getFileContentsAsList());
    }

    public function testItWillFindBiggestBlockSum(): void
    {
        $fileName = self::TEST_FILE_ONE;

        $app = new App($fileName);
        self::assertSame(13210, $app->getTopXResults(1)[0]);
    }

    public function testItWillFindBiggestBlockSumFromRealFile(): void
    {
        $fileName = self::REAL_FILE;

        $app = new App($fileName);
        self::assertSame(68467, $app->getTopXResults(1)[0]);
    }

    /**
     * @throws Exception
     */
    public function testResultArrayWillBeReturned(): void
    {
        $fileName = self::TEST_FILE_ONE;

        $app = new App($fileName);

        self::assertSame([901, 13210], $app->getAllResults());
    }

    public function testGetResultListSortedDescending(): void
    {
        $fileName = self::TEST_FILE_TWO;

        $app = new App($fileName);

        self::assertSame([464849, 13210, 10564, 901, 385, 59], $app->getAllResultsSortedDescending());
    }

    public function testGetTopThree(): void
    {
        $fileName = self::TEST_FILE_TWO;

        $app = new App($fileName);

        self::assertSame([464849, 13210, 10564], $app->getTopXResults(3));
    }

    public function testGetTopTwo(): void
    {
        $fileName = self::TEST_FILE_TWO;

        $app = new App($fileName);

        self::assertSame([464849, 13210], $app->getTopXResults(2));
    }

    public function testGetTotalTopThreeFromRealFile(): void
    {
        $fileName = self::REAL_FILE;

        $app = new App($fileName);

        self::assertSame(203420, array_sum($app->getTopXResults(3)));
    }
}

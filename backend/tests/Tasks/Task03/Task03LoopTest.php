<?php

declare(strict_types=1);

namespace App\Tests\Tasks\Task03;

use App\Tasks\Task03\OutputWriter;
use App\Tasks\Task03\Task03Loop;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class Task03LoopTest extends TestCase
{
    public function testRun() : void
    {
        $loop = new Task03Loop();
        $loop->run($this->createWriterMock());
    }

    /**
     * @return OutputWriter|MockObject
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    private function createWriterMock()
    {
        $writer = $this->createMock(OutputWriter::class);
        $writer
            ->expects($this->exactly(91))
            ->method('writeln')
            ->withConsecutive(
                ['Iteration number: 0, ok'],
                ['Iteration number: 1, ok'],
                ['Iteration number: 2, good'],
                ['Iteration number: 3, ok'],
                ['Iteration number: 4, excellent'],
                ['Iteration number: 5, good'],
                ['Iteration number: 6, ok'],
                ['Iteration number: 7, ok'],
                ['Iteration number: 8, good'],
                ['Iteration number: 9, excellent'],
                ['Iteration number: 10, ok'],
                ['Iteration number: 11, good'],
                ['Iteration number: 12, ok'],
                ['Iteration number: 13, ok'],
                ['Iteration number: 14, good and excellent'],
                ['Iteration number: 15, ok'],
                ['Iteration number: 16, ok'],
                ['Iteration number: 17, good'],
                ['Iteration number: 18, ok'],
                ['Iteration number: 19, excellent'],
                ['Iteration number: 20, good'],
                ['Iteration number: 21, ok'],
                ['Iteration number: 22, ok'],
                ['Iteration number: 23, good'],
                ['Iteration number: 24, excellent'],
                ['Iteration number: 25, ok'],
                ['Iteration number: 26, good'],
                ['Iteration number: 27, ok'],
                ['Iteration number: 28, ok'],
                ['Iteration number: 29, good and excellent'],
                ['Iteration number: 30, ok'],
                ['Iteration number: 31, ok'],
                ['Iteration number: 32, good'],
                ['Iteration number: 33, ok'],
                ['Iteration number: 34, excellent'],
                ['Iteration number: 35, good'],
                ['Iteration number: 36, ok'],
                ['Iteration number: 37, ok'],
                ['Iteration number: 38, good'],
                ['Iteration number: 39, excellent'],
                ['Iteration number: 40, ok'],
                ['Iteration number: 41, good'],
                ['Iteration number: 42, ok'],
                ['Iteration number: 43, ok'],
                ['Iteration number: 44, good and excellent'],
                ['Iteration number: 45, ok'],
                ['Iteration number: 46, ok'],
                ['Iteration number: 47, good'],
                ['Iteration number: 48, ok'],
                ['Iteration number: 49, excellent'],
                ['Iteration number: 50, good'],
                ['Iteration number: 51, ok'],
                ['Iteration number: 52, ok'],
                ['Iteration number: 53, good'],
                ['Iteration number: 54, excellent'],
                ['Iteration number: 55, ok'],
                ['Iteration number: 56, good'],
                ['Iteration number: 57, ok'],
                ['Iteration number: 58, ok'],
                ['Iteration number: 59, good and excellent'],
                ['Iteration number: 60, ok'],
                ['Iteration number: 61, ok'],
                ['Iteration number: 62, good'],
                ['Iteration number: 63, ok'],
                ['Iteration number: 64, excellent'],
                ['Iteration number: 65, good'],
                ['Iteration number: 66, ok'],
                ['Iteration number: 67, ok'],
                ['Iteration number: 68, good'],
                ['Iteration number: 69, excellent'],
                ['Iteration number: 70, ok'],
                ['Iteration number: 71, good'],
                ['Iteration number: 72, ok'],
                ['Iteration number: 73, ok'],
                ['Iteration number: 74, good and excellent'],
                ['Iteration number: 75, ok'],
                ['Iteration number: 76, ok'],
                ['Iteration number: 77, good'],
                ['Iteration number: 78, ok'],
                ['Iteration number: 79, excellent'],
                ['Iteration number: 80, good'],
                ['Iteration number: 81, ok'],
                ['Iteration number: 82, ok'],
                ['Iteration number: 83, good'],
                ['Iteration number: 84, excellent'],
                ['Iteration number: 85, ok'],
                ['Iteration number: 86, good'],
                ['Iteration number: 87, ok'],
                ['Iteration number: 88, ok'],
                ['Iteration number: 89, good and excellent'],
                ['Iteration number: 90, Stop!']
            );

        return $writer;
    }
}

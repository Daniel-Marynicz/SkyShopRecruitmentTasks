<?php

declare(strict_types=1);

namespace App\Tasks\Task03;

use function sprintf;

class Task03Loop
{
    public function run(OutputWriter $output) : void
    {
        $iterationNumber  = 0;
        $appearanceNumber = 1;
        for ($i=100; $i>=0; $i--) {
            if ($iterationNumber > 90) {
                break;
            }

            $text    = $this->getText($appearanceNumber, $iterationNumber);
            $message = sprintf('Iteration number: %d, %s', $iterationNumber, $text);

            $output->writeln($message);
            $iterationNumber++;
            $appearanceNumber++;
        }
    }

    private function getText(int $appearanceNumber, int $iterationNumber) : string
    {
        if ($iterationNumber === 90) {
            return 'Stop!';
        }

        $good      = $this->isDivisibleBy($appearanceNumber, 3);
        $excellent = $this->isDivisibleBy($appearanceNumber, 5);

        switch (true) {
            case $good && $excellent:
                return 'good and excellent';
            case $good:
                return 'good';
            case $excellent:
                return 'excellent';
            default:
                return 'ok';
        }
    }

    private function isDivisibleBy(int $dividend, int $divisor) : bool
    {
        return $dividend % $divisor === 0;
    }
}

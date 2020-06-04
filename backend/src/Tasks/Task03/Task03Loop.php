<?php

declare(strict_types=1);

namespace App\Tasks\Task03;

use function sprintf;

class Task03Loop
{
    /** @var array<string,string> */
    private array $textDictionary = [
        'good' => 'good',
        'excellent' => 'excellent',
        'goodexcellent' => 'good and excellent',
    ];

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

        $good      = $this->isDivisibleBy($appearanceNumber, 3) ? 'good' : null;
        $excellent = $this->isDivisibleBy($appearanceNumber, 5) ? 'excellent' : null;
        $textKey   = $good . $excellent;

        return $this->textDictionary[$textKey] ?? 'ok';
    }

    private function isDivisibleBy(int $dividend, int $divisor) : bool
    {
        return $dividend % $divisor === 0;
    }
}

<?php

declare(strict_types=1);

namespace App\Tasks\Task03;

use Symfony\Component\Console\Output\OutputInterface;

class OutputWriter
{
    /** @var OutputInterface[] */
    private array $outputs;

    /**
     * @param OutputInterface[] $outputs
     */
    public function __construct(array $outputs)
    {
        $this->outputs = $outputs;
    }

    public function writeln(string $messages) : void
    {
        foreach ($this->outputs as $output) {
            $output->writeln($messages);
        }
    }
}

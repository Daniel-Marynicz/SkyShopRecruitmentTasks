<?php

declare(strict_types=1);

namespace App\Tasks\Task03;

use DateTime;
use LogicException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\StreamOutput;
use function fclose;
use function fopen;
use function is_resource;
use function sprintf;

class Task03Command extends Command
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected static $defaultName = 'task:task03';

    /**
     * {@inheritdoc}
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $date       = (new DateTime())->format('Y-m-d H.i');
        $fileName   = sprintf('Task03Output %s.log', $date);
        $fileHandle = fopen($fileName, 'wb');

        if (! is_resource($fileHandle)) {
            throw new LogicException(sprintf('Can\'t open file %s for writing', $fileName));
        }

        $fileOutput   = new StreamOutput($fileHandle);
        $outputWriter = new OutputWriter([$output, $fileOutput]);
        $loop         = new Task03Loop();
        $loop->run($outputWriter);
        fclose($fileHandle);

        return 0;
    }
}

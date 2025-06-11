<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\GOLService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('run:game', aliases: ['r:g'])]
class RunCommand extends Command
{
    public function __construct(
        private GOLService $golService,
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return Command::SUCCESS;
    }
}

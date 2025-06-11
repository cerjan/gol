<?php

declare(strict_types=1);

namespace App\Command;

use App\Command\Input\InputValidator;
use App\Service\GOLService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('run:game', aliases: ['r:g'])]
class RunCommand extends Command
{
    public function __construct(
        private GOLService              $golService,
        private readonly InputValidator $inputValidator,
    )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->addArgument('inputFile', InputArgument::REQUIRED, 'Input XML file');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $inputFile = $this->inputValidator->validate($input);



        return Command::SUCCESS;
    }
}

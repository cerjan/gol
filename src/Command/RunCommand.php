<?php

declare(strict_types=1);

namespace App\Command;

use App\Command\Input\InputValidator;
use App\Model\Life;
use App\Service\GOLService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\SerializerInterface;

#[AsCommand('run:game', aliases: ['r:g'])]
class RunCommand extends Command
{
    public function __construct(
        private readonly InputValidator $inputValidator,
        private readonly SerializerInterface $serializer,
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
        $inputFile = $this->inputValidator->validateInputFile($input);

        $life = $this->serializer->deserialize(file_get_contents($inputFile), Life::class, 'xml');

        $game = new GOLService($life);

        while (null !== $organisms = $game->iterate()) {
            system('clear');
            foreach ($organisms as $organism) {
                $output->writeln(implode('', array_map(fn($o) => $o->getSpecies(), $organism)));
            }
            usleep(100000);
        }

        return Command::SUCCESS;
    }
}

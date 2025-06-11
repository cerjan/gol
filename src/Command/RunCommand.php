<?php

declare(strict_types=1);

namespace App\Command;

use App\Command\Input\InputValidator;
use App\Service\FileReader;
use App\Service\GameOfLife;
use App\Service\LifeSerializer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('run:game', aliases: ['r:g'])]
class RunCommand extends Command
{
    public function __construct(
        private readonly InputValidator $inputValidator,
        private readonly LifeSerializer $lifeSerializer,
        private readonly FileReader $fileReader,
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
        $xmlContent = $this->fileReader->getContent($inputFile);
        $life = $this->lifeSerializer->deserializeFromXmlContent($xmlContent);

        $game = new GameOfLife($life);

        while (null !== $organisms = $game->iterate()) {
            system('clear');
            foreach ($organisms as $organism) {
                $output->writeln(implode('', array_map(fn($o) => 'a', $organism)));
            }
            usleep(100000);
        }

        return Command::SUCCESS;
    }
}

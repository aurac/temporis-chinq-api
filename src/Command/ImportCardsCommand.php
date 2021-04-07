<?php
/**
 * ImportCardsCommand.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 06/04/2021
 *
 * @version 1.0
 */

namespace App\Command;

use App\Service\CardImporter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCardsCommand extends Command
{
    protected static $defaultName = 'chinq:cards:import';

    private string $projectDir;
    private CardImporter $cardImporter;

    protected function configure()
    {
        $this
            ->addArgument('filename', InputArgument::REQUIRED, 'File name')
            ->setDescription('Import cards in the database')
            ->setHelp('Import cards in the database from input file');
    }

    public function __construct(CardImporter $cardImporter, string $projectDir)
    {
        $this->cardImporter = $cardImporter;
        $this->projectDir = $projectDir;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filename = $this->projectDir.'/'.$input->getArgument('filename');

        if (!file_exists($filename)) {
            $output->writeln('File '.$filename.' does not exist');
            return Command::FAILURE;
        }

        $content = json_decode(file_get_contents($filename), true);

        return $this->cardImporter->execute($content);
    }
}
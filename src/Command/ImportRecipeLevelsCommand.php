<?php
/**
 * ImportRecipeLevelsCommand.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 20/04/2021
 *
 * @version 1.0
 */

namespace App\Command;


use App\Repository\CardRepository;
use App\Repository\RecipeLevelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportRecipeLevelsCommand extends Command
{
    protected static $defaultName = 'chinq:levels:import';

    private EntityManagerInterface $entityManager;

    private RecipeLevelRepository $recipeLevelRepository;

    private CardRepository $cardRepository;

    private string $projectDir;

    protected function configure()
    {
        $this
            ->addArgument('filename', InputArgument::REQUIRED, 'File name')
            ->setDescription('Import recipe levels in the database')
            ->setHelp('Import recipe levels in the database from input file');
    }

    public function __construct(
        EntityManagerInterface $entityManager,
        RecipeLevelRepository $recipeLevelRepository,
        CardRepository $cardRepository,
        string $projectDir
    )
    {
        $this->entityManager = $entityManager;
        $this->recipeLevelRepository = $recipeLevelRepository;
        $this->projectDir = $projectDir;
        $this->cardRepository = $cardRepository;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filename = $this->projectDir . '/' . $input->getArgument('filename');

        if (!file_exists($filename)) {
            $output->writeln('File ' . $filename . ' does not exist');
            return Command::FAILURE;
        }

        $content = json_decode(file_get_contents($filename), true);

        foreach ($content as $level) {
            $recipeLevel = $this->recipeLevelRepository->findOneBy([
                'level' => $level['level']
            ]);

            if (!$recipeLevel) {
                $output->writeln('Recipe level with level  ' . $level . ' not found.');
            }

            foreach ($level['cards'] as $card) {
                $cardObj = $this->cardRepository->findOneBy([
                    'externalId' => $card
                ]);

                if (!$cardObj) {
                    $output->writeln('Card with externalId  ' . $card . ' not found.');
                    continue;
                }

                $recipeLevel->addCard($cardObj);
            }


            $output->writeln('Recipe level ' . $level['level'] . ' successfully updated.');
            $this->entityManager->persist($recipeLevel);
            $this->entityManager->flush();
            $this->entityManager->clear();
        }

        return Command::SUCCESS;
    }
}
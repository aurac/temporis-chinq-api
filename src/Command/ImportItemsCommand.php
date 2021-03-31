<?php
/**
 * ImportItemsCommand.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 31/03/2021
 *
 * @version 1.0
 */

namespace App\Command;


use App\Entity\Item;
use App\Repository\ItemRepository;
use App\Repository\SubTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportItemsCommand extends Command
{
    protected static $defaultName = 'chinq:import-items';

    private EntityManagerInterface $entityManager;

    private SubTypeRepository $subTypeRepository;

    private ItemRepository $itemRepository;

    private string $projectDir;

    protected function configure()
    {
        $this
            ->addArgument('filename', InputArgument::REQUIRED, 'File name')
            ->setDescription('Import items in the database')
            ->setHelp('Import items in the database from input file')
        ;
    }

    public function __construct(
        EntityManagerInterface $entityManager,
        SubTypeRepository $subTypeRepository,
        ItemRepository $itemRepository,
        string $projectDir
    )
    {
        $this->entityManager = $entityManager;
        $this->subTypeRepository = $subTypeRepository;
        $this->itemRepository = $itemRepository;
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

        foreach ($content as $type => $items) {
            foreach ($items as $item) {
                $subType = $this->subTypeRepository->findOneBy([
                    'name' => $item['type']
                ]);

                if (!$subType) {
                    $output->writeln('SubType '.$item['type'].' does not exist');
                    continue;
                }

                $itemObj = $this->itemRepository->findOneBy([
                    'name' => $item['name']
                ]);

                if ($itemObj) {
                    $output->writeln('Item '.$item['name'].' already exists');
                    continue;
                }

                $itemObj = new Item();
                $itemObj->setName($item['name'])
                    ->setLevel($item['level'])
                    ->setLink($item['url'])
                    ->setImgLink($item['img'])
                    ->setSubType($subType)
                ;

                $this->entityManager->persist($itemObj);
                $this->entityManager->flush();
                $output->writeln('Item '.$item['name'].' successfully added');

                $this->entityManager->clear();
            }
        }

        return Command::SUCCESS;
    }
}
<?php
/**
 * DownloadItemImagesCommand.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 07/04/2021
 *
 * @version 1.0
 */

namespace App\Command;

use App\Repository\ItemRepository;
use App\Service\CardImporter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DownloadItemImagesCommand extends Command
{
    protected static $defaultName = 'chinq:items:download-images';

    private string $uploadDir;
    private CardImporter $cardService;
    private ItemRepository $itemRepository;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    protected function configure()
    {
        $this->setDescription('Download items images')
            ->setHelp('Download items from item image link file');
    }

    public function __construct(ItemRepository $itemRepository, EntityManagerInterface $entityManager, CardImporter $cardService, string $uploadDir)
    {
        $this->uploadDir = $uploadDir;
        $this->cardService = $cardService;
        $this->itemRepository = $itemRepository;
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $itemIds = $this->itemRepository->getItemsIdWithoutImage();
        @mkdir($this->uploadDir.'/images/items/png/', 0777, true);
        foreach ($itemIds as $itemId) {
            $item = $this->itemRepository->findOneBy(['id' => $itemId]);
            $fileName = $this->cardService->cardNameToFileName($item->getName()) . '.png';
            $img = $this->uploadDir . '/images/items/png/' . $fileName;

            $contents = @file_get_contents($item->getImgLink());
            if (!$contents) {
                $output->writeln('Failed to download ' . $fileName);
            } else {
                $output->writeln('Successfully dowloaded ' . $fileName);
            }

            file_put_contents($img, $contents);

            $this->entityManager->clear();
        }

        return Command::SUCCESS;
    }
}
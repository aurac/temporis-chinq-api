<?php
/**
 * CreateItemsMediaObjectsCommand.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 08/04/2021
 *
 * @version 1.0
 */

namespace App\Command;

use App\Entity\MediaObject;
use App\Repository\ItemRepository;
use App\Service\CardImporter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateItemsMediaObjectsCommand extends Command
{
    protected static $defaultName = 'chinq:items:media-objects';

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

        foreach ($itemIds as $itemId) {
            $item = $this->itemRepository->findOneBy(['id' => $itemId]);
            $fileName = $this->cardService->cardNameToFileName($item->getName()) . '.png';

            if (!file_exists($this->uploadDir.'/images/items/png/'.$fileName)) {
                $output->writeln('Image '.$fileName.' does not exist');
                continue;
            }

            $mediaObject = new MediaObject();
            $mediaObject->setFilePath('images/items/png/' . $fileName);
            $this->entityManager->persist($mediaObject);

            $item->setImage($mediaObject);

            $this->entityManager->persist($item);
            $this->entityManager->flush();
            $output->writeln('Image '.$fileName.' successfully added to item '.$item->getName());

            $this->entityManager->clear();
        }

        return Command::SUCCESS;
    }
}
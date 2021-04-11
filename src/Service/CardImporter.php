<?php
/**
 * CardImporter.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 07/04/2021
 *
 * @version 1.0
 */

namespace App\Service;


use App\Entity\Card;
use App\Entity\MediaObject;
use App\Entity\Rarity;
use App\Entity\Source;
use App\Repository\CardTypeRepository;
use App\Repository\RarityRepository;
use App\Repository\SourceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class CardImporter
{
    private EntityManagerInterface $entityManager;
    private CardTypeRepository $cardTypeRepository;
    private RarityRepository $rarityRepository;
    private SourceRepository $sourceRepository;
    private string $projectDir;
    private LoggerInterface $logger;

    public function __construct(
        EntityManagerInterface $entityManager,
        CardTypeRepository $cardTypeRepository,
        RarityRepository $rarityRepository,
        SourceRepository $sourceRepository,
        LoggerInterface $logger,
        string $projectDir
    )
    {
        $this->entityManager = $entityManager;
        $this->cardTypeRepository = $cardTypeRepository;
        $this->rarityRepository = $rarityRepository;
        $this->sourceRepository = $sourceRepository;
        $this->projectDir = $projectDir;
        $this->logger = $logger;
    }

    public function execute($content): bool
    {
        foreach ($content as $item) {
            $type = $this->cardTypeRepository->findOneBy([
                'name' => $item['type']
            ]);

            if (!$type) {
                $this->logger->alert('CardType '.$item['type'].' does not exist');
                continue;
            }

            $rarity = $this->findRarity($item);
            $source = $this->findSource($item);

            $card = new Card();
            $card->setName($item['name'])
                ->setType($type)
            ;

            if (isset($item['level'])) {
                $card->setLevel($item['level']);
            }

            if ($rarity) {
                $card->setRarity($rarity);
            }
            if ($source) {
                $card->setSource($source);
            }

            $this->getImages($card, $item['id']);

            $this->entityManager->persist($card);
            $this->entityManager->flush();
            $this->logger->info('Card '.$item['name'].' successfully added');

            $this->entityManager->clear();
        }

        return true;
    }

    private function findSource($item): ?Source
    {
        if (!isset($item['profession'])) {
            return null;
        }

        $parentSource = $this->sourceRepository->findOneBy([
            'name' => $item['profession']
        ]);

        if (!$parentSource) {
            $this->logger->alert('Source '.$item['profession'].' does not exist');
            return null;
        }

        $key = null;
        $source = null;
        switch ($item['profession']) {
            case 'Monstres':
                $key = 'monster';
                break;
            default:
                break;
        }

        if ($key && isset($item[$key])) {
            $source = $this->findChildSource($item[$key], $parentSource);
        }

        return $source ? $source : $parentSource;
    }


    private function findChildSource($name, $parentSource): Source
    {
        $source = $this->sourceRepository->findOneBy([
            'name' => $name
        ]);
        if (!$source) {
            $source = new Source();
            $source->setName($name)
                ->setParent($parentSource);
            $this->entityManager->persist($source);
        }

        return $source;
    }

    private function getImages(Card $card, $id)
    {
        $arrExt = ['png', 'svg'];

        foreach ($arrExt as $ext) {
            $fileName = 'images/'.$ext.'/'.$this->cardNameToFileName($card->getName()).'.'.$ext;

            $mediaObject = $this->getMediaObject($fileName);

            if (method_exists($card, 'setImage'.ucfirst($ext))) {
                $card->{'setImage'.ucfirst($ext)}($mediaObject);
            }
        }
    }

    private function getMediaObject(string $fileName): MediaObject
    {
        $mediaObject = new MediaObject();
        $mediaObject->setFilePath($fileName);
        $this->entityManager->persist($mediaObject);

        return $mediaObject;
    }

    private function downloadImage($id, $extension, $fileName): bool
    {
        $url = 'https://cdn.jsdelivr.net/gh/jdathueyt/dofus-temporis-v-cards/'.$extension.'/'.$id.'.'.$extension;

        $img = $this->projectDir.'/public/media/'.$fileName;

        if (file_put_contents($img, file_get_contents($url))) {
            return true;
        }

        return false;
    }

    public function cardNameToFileName($name): string
    {
        $accents = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
        $name = strtr( $name, $accents );

        return strtolower(
            str_replace(' ', '_',
                preg_replace(
                    '/\s+/',
                    ' ',
                    preg_replace(
                        '/[^A-Za-z0-9_ ]/',
                        '',
                        $name
                    )
                )
            )
        );
    }

    private function findRarity($item): ?Rarity
    {
        if (!isset($item['color'])) {
            return null;
        }

        $rarity = $this->rarityRepository->findOneBy([
            'name' => $item['color']
        ]);

        if (!$rarity) {
            $this->logger->alert('Rarity '.$item['color'].' does not exist');
        }

        return $rarity;
    }
}
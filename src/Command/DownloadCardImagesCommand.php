<?php
/**
 * DownloadCardImagesCommand.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 07/04/2021
 *
 * @version 1.0
 */

namespace App\Command;


use App\Service\CardImporter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DownloadCardImagesCommand extends Command
{
    protected static $defaultName = 'chinq:cards:download-images';

    private string $projectDir;
    private string $uploadDir;
    private string $urlCardImage;
    private CardImporter $cardService;

    protected function configure()
    {
        $this
            ->addArgument('filename', InputArgument::REQUIRED, 'File name')
            ->setDescription('Download cards images')
            ->setHelp('Download images from input file');
    }

    public function __construct(CardImporter $cardService, string $projectDir, string $uploadDir, string $urlCardImage)
    {
        $this->projectDir = $projectDir;
        $this->uploadDir = $uploadDir;
        $this->urlCardImage = $urlCardImage;
        $this->cardService = $cardService;
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

        $arrExt = ['png', 'svg'];

        foreach ($content as $item) {
            foreach ($arrExt as $extension) {
                $url = $this->urlCardImage.'/'.$extension.'/'.$item['id'].'.'.$extension;

                $fileName = $this->cardService->cardNameToFileName($item['name']).'.'.$extension;
                $img = $this->uploadDir.'/images/'.$extension.'/'.$fileName;

                @mkdir($this->uploadDir.'/images/'.$extension, 0777, true);
                if (!file_put_contents($img, file_get_contents($url))) {
                    $output->writeln('Failed to download '.$fileName);
                } else {
                    $output->writeln('Successfully dowloaded '.$fileName);
                }
            }
        }

        return Command::SUCCESS;
    }
}
<?php
/**
 * CreateUserCommand.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 13/04/2021
 *
 * @version 1.0
 */

namespace App\Command;


use App\Service\CreateUserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'chinq:user:create';

    private CreateUserService $createUserService;

    protected function configure()
    {
        $this->setDescription('Create user')
            ->addArgument('username', InputArgument::REQUIRED, 'Username')
            ->addArgument('password', InputArgument::REQUIRED, 'Password')
            ->addOption(
                'admin',
                'a',
                InputOption::VALUE_NONE,
                'Set the user as admin'
            )
            ->setHelp('Create user');
    }

    public function __construct(CreateUserService $createUserService)
    {
        parent::__construct();
        $this->createUserService = $createUserService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');
        $role = $input->getOption('admin') ? $role = ['ROLE_ADMIN'] : [] ;

        try {
            $this->createUserService->execute($username, $password, $role);
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
            return Command::FAILURE;
        }

        $output->writeln('User '. ($input->getOption('admin') ? 'admin ': '').$username.' successfully created');
        return Command::SUCCESS;
    }
}

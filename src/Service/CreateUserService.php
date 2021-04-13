<?php
/**
 * CreateUserService.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 13/04/2021
 *
 * @version 1.0
 */

namespace App\Service;


use App\Factory\UserFactory;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateUserService
{
    private EntityManagerInterface $entityManager;
    private UserRepository $userRepository;

    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
    }

    public function execute(string $username, string $password, array $roles = []): bool
    {
        $user = $this->userRepository->findOneBy([
            'username' => $username
        ]);

        if ($user) {
            throw new \Exception('User with username "'.$username.'" already exists');
        }

        UserFactory::new([
            'username' => $username,
            'password' => $password,
            'roles' => $roles
        ])->create();

        return true;
    }
}
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


use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUserService
{
    private EntityManagerInterface $entityManager;
    private UserRepository $userRepository;
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function execute(string $username, string $password, array $roles = []): bool
    {
        $user = $this->userRepository->findOneBy([
            'username' => $username
        ]);

        if ($user) {
            throw new \Exception('User with username "'.$username.'" already exists');
        }

        $user = new User();
        $user->setUsername($username)
            ->setPassword($this->passwordEncoder->encodePassword($user, $password))
            ->setRoles($roles)
        ;

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return true;
    }
}
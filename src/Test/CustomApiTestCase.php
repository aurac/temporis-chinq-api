<?php
/**
 * CustomApiTestCase.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 05/04/2021
 *
 * @version 1.0
 */

namespace App\Test;


use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use App\Entity\User;
use App\Factory\UserFactory;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class CustomApiTestCase extends ApiTestCase
{
    use ResetDatabase, Factories;

    protected function createUser(string $password): User
    {
        return UserFactory::new(['password' => $password])
            ->create()
            ->object()
        ;
    }

    protected function createUserAdmin(string $password): User
    {
        return UserFactory::new(['password' => $password])
            ->admin()
            ->create()
            ->object()
        ;
    }

    protected function login(Client $client, User $user, string $password): ResponseInterface
    {
        $response = $client->request('POST', '/login', [
            'json' => [
                'username' => $user->getUsername(),
                'password' => $password
            ]
        ]);

        $this->assertResponseStatusCodeSame(204);
        $this->assertResponseHasHeader('Location', '/api/users/'.$user->getId());

        return $response;
    }

    protected function loginAdmin(Client $client, User $user, string $password): ResponseInterface
    {
        $response = $this->login($client, $user, $password);

        $headers = $response->getHeaders();

        $client->request('GET', $headers['location'][0]);
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains(['isAdmin' => true]);

        return $response;
    }

    protected function createUserAndLogin(Client $client, string $password): User
    {
        $user = $this->createUser($password);

        $this->login($client, $user, $password);

        return $user;
    }

    protected function createUserAdminAndLogin(Client $client, string $password): User
    {
        $user = $this->createUserAdmin($password);

        $this->loginAdmin($client, $user, $password);

        return $user;
    }

    protected function testNotLoggedInUnauthorized($client, $method, $route)
    {
        $client->request($method, $route, ['json'=>[]]);
        $this->assertResponseStatusCodeSame(401);
    }
}
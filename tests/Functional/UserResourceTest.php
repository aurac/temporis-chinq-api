<?php
/**
 * UserResourceTest.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 05/04/2021
 *
 * @version 1.0
 */

namespace App\Tests\Functional;


use App\Entity\User;
use App\Test\CustomApiTestCase;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;

class UserResourceTest extends CustomApiTestCase
{
    use ReloadDatabaseTrait;

    public function testCreateUser()
    {
        $client = self::createClient();

        $client->request('POST', '/api/users', [
            'json' => [
                'email' => 'test@test.fr',
                'username' => 'test',
                'password' => 'password'
            ]
        ]);

        $this->assertResponseStatusCodeSame(201);

        $this->logIn($client, 'test@test.fr', 'password');
    }

    public function testUpdateUser()
    {
        $client = self::createClient();

        $user = $this->createUserAndLogin($client, 'test@test.fr', 'password');

        $client->request('PUT', '/api/users/'.$user->getId(), [
            'json' => [
                'username' => 'updated'
            ]
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'username' => 'updated'
        ]);
    }

    public function testGetUser()
    {
        $client = self::createClient();
        $user = $this->createUserAndLogin($client, 'test@test.fr', 'password');

        $user2 = $this->createUser('test2@test.fr', 'password');

        $client->request('GET', '/api/users/'.$user2->getId());

        $this->assertJsonContains([
            'username' => 'test2'
        ]);
        $data = $client->getResponse()->toArray();
        $this->assertArrayNotHasKey('email', $data);

        $em = $this->getEntityManager();
        $user = $em->getRepository(User::class)->find($user->getId());
        $user->setRoles(['ROLE_ADMIN']);
        $em->persist($user);
        $em->flush();

        $this->login($client, 'test@test.fr', 'password');

        $client->request('GET', '/api/users/'.$user2->getId());

        $this->assertJsonContains([
            'email' => 'test2@test.fr'
        ]);
    }
}
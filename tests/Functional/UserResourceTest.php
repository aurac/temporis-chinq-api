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
use App\Factory\UserFactory;
use App\Test\CustomApiTestCase;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;

/**
 * Class UserResourceTest
 * @package App\Tests\Functional
 * @group users
 */
class UserResourceTest extends CustomApiTestCase
{
    public function testGetCollectionUser()
    {
        $client = self::createClient();

        // test not logged in, unauthorized
        $this->testNotLoggedInUnauthorized($client, 'GET', '/api/users');

        // test logged in, success
        $this->createUserAndLogin($client, 'password');
        $client->request('GET', '/api/users');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetItemUser()
    {
        $user = UserFactory::createOne();
        $userAdmin = UserFactory::new()
            ->admin()
            ->create()
        ;

        self::ensureKernelShutdown();
        $client = self::createClient();

        // test not logged in, unauthorized
        $this->testNotLoggedInUnauthorized($client, 'GET', '/api/users');

        // test user get other user
        $this->createUserAndLogin($client, 'password');
        $client->request('GET', '/api/users/'.$userAdmin->getId());
        $this->assertResponseStatusCodeSame(200);
        $data = $client->getResponse()->toArray();
        $this->assertArrayNotHasKey('isAdmin', $data);

        // test admin get other user
        $this->createUserAdminAndLogin($client, 'password');
        $client->request('GET', '/api/users/'.$user->getId());
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains(['isAdmin' => false]);

        // test admin get other admin
        $client->request('GET', '/api/users/'.$userAdmin->getId());
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains(['isAdmin' => true]);
    }

    public function testCreateUser()
    {
        $client = self::createClient();

        // test not logged in, unauthorized
        $this->testNotLoggedInUnauthorized($client, 'POST', '/api/users');

        // test forbidden
        $this->createUserAndLogin($client, 'password');
        $client->request('POST', '/api/users', [
            'json' => []
        ]);
        $this->assertResponseStatusCodeSame(403);

        // test success
        $adminCreator = $this->createUserAdminAndLogin($client, 'password');
        $client->request('POST', '/api/users', [
            'json' => [
                'username' => 'test',
                'password' => 'password'
            ]
        ]);

        $this->assertResponseStatusCodeSame(201);
        UserFactory::assert()->exists([
            'username' => 'test'
        ]);
        $user = UserFactory::find([
            'username' => 'test'
        ])->object();

        $this->login($client, $user, 'password');

        // test create admin user success
        $this->loginAdmin($client, $adminCreator, 'password');
        $client->request('POST', '/api/users', [
            'json' => [
                'username' => 'administrateur',
                'password' => 'password',
                'roles' => [
                    'ROLE_ADMIN'
                ]
            ]
        ]);
        $this->assertResponseStatusCodeSame(201);

        UserFactory::assert()->exists([
            'username' => 'administrateur'
        ]);
        $admin = UserFactory::find([
            'username' => 'administrateur'
        ])->object();

        $this->loginAdmin($client, $admin, 'password');
    }

    public function testUpdateUser()
    {
        $user = UserFactory::new()
            ->create()
            ->enableAutoRefresh()
        ;

        $client = self::createClient();

        // test not logged in, unauthorized
        $this->testNotLoggedInUnauthorized($client, 'PUT', '/api/users/'.$user->getId());

        // test user modifying other user
        $this->createUserAndLogin($client, 'password');
        $client->request('PUT', '/api/users/'.$user->getId(), [
            'json' => [
                'username' => 'test',
                'password' => 'password'
            ]
        ]);
        $this->assertResponseStatusCodeSame(403);

        // test user modifying himself with role admin
        $this->login($client, $user->object(), 'password');
        $client->request('PUT', '/api/users/'.$user->getId(), [
            'json' => [
                'username' => 'newusername',
                'password' => 'newpassword',
                'roles' => [
                    'ROLE_ADMIN'
                ]
            ]
        ]);
        $this->assertResponseStatusCodeSame(200);
        $this->assertEquals('newusername', $user->getUsername());
        $data = $client->getResponse()->toArray();
        $this->assertArrayNotHasKey('isAdmin', $data);
        $this->login($client, $user->object(), 'newpassword');

        // test admin modifying other user
        $this->createUserAdminAndLogin($client, 'password');
        $client->request('PUT', '/api/users/'.$user->getId(), [
            'json' => [
                'username' => 'newusernameadmin',
                'password' => 'newpasswordadmin',
                'roles' => [
                    'ROLE_ADMIN'
                ]
            ]
        ]);
        $this->assertResponseStatusCodeSame(200);
        $this->assertEquals('newusernameadmin', $user->getUsername());
        $this->assertJsonContains(['isAdmin' => true]);

        $this->loginAdmin($client, $user->object(), 'newpasswordadmin');
    }

    public function testDeleteUser()
    {
        $user = UserFactory::new(['username' => 'username'])
            ->create()
        ;

        self::ensureKernelShutdown();
        $client = self::createClient();

        $this->testNotLoggedInUnauthorized($client, 'DELETE', '/api/users/'.$user->getId());

        // test forbidden
        $this->createUserAndLogin($client, 'password');
        $client->request('DELETE', '/api/users/'.$user->getId());
        $this->assertResponseStatusCodeSame(403);

        // test not found
        $this->createUserAdminAndLogin($client, 'password');
        $client->request('DELETE', '/api/users/test');
        $this->assertResponseStatusCodeSame(404);

        // test successful delete
        $client->request('DELETE', '/api/users/'.$user->getId());
        $this->assertResponseStatusCodeSame(204);
        UserFactory::assert()->notExists([
            'username' => 'username'
        ]);
    }
}
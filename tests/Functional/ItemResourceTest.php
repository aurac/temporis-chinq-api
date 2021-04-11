<?php
/**
 * ItemResourceTest.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 10/04/2021
 *
 * @version 1.0
 */

namespace App\Tests\Functional;


use App\Factory\ItemFactory;
use App\Factory\SubTypeFactory;
use App\Test\CustomApiTestCase;

/**
 * Class ItemResourceTest
 * @package App\Tests\Functional
 * @group items
 */
class ItemResourceTest extends CustomApiTestCase
{
    public function testGetCollectionItem()
    {
        $client = self::createClient();

        // test not logged in, unauthorized
        $this->testNotLoggedInUnauthorized($client, 'GET', '/api/items');

        // test logged in, success
        $this->createUserAndLogin($client, 'password');
        $client->request('GET', '/api/items');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetItemItem()
    {
        $item = ItemFactory::createOne();

        self::ensureKernelShutdown();
        $client = self::createClient();

        // test not logged in, unauthorized
        $this->testNotLoggedInUnauthorized($client, 'GET', '/api/items/'.$item->getId());

        $this->createUserAndLogin($client, 'password');

        // test not found
        $client->request('GET', '/api/items/test');
        $this->assertResponseStatusCodeSame(404);

        // test success
        $client->request('GET', '/api/items/'.$item->getId());
        $this->assertResponseStatusCodeSame(200);
    }

    public function testCreateItem()
    {
        $subType = SubTypeFactory::createOne();

        self::ensureKernelShutdown();
        $client = self::createClient();

        // test not logged in, unauthorized
        $this->testNotLoggedInUnauthorized($client, 'POST', '/api/items');

        // test forbidden
        $this->createUserAndLogin($client, 'password');
        $client->request('POST', '/api/items', [
            'json' => []
        ]);
        $this->assertResponseStatusCodeSame(403);

        // test missing data
        $this->createUserAdminAndLogin($client, 'password');
        $client->request('POST', '/api/items', [
            'json' => []
        ]);
        $this->assertResponseStatusCodeSame(422);

        // test created success
        $client->request('POST', '/api/items', [
            'json' => [
                'subType' => '/api/sub_types/'.$subType->getId(),
                'name' => 'Item test',
                'level' => 10,
            ]
        ]);
        $this->assertResponseStatusCodeSame(201);
        ItemFactory::assert()->exists([
            'name' => 'Item test',
            'level' => 10,
        ]);
    }

    public function testUpdateItem()
    {
        $item = ItemFactory::createOne(['level' => 10]);

        self::ensureKernelShutdown();
        $client = self::createClient();

        $this->testNotLoggedInUnauthorized($client, 'PUT', '/api/items/'.$item->getId());

        // test forbidden
        $this->createUserAndLogin($client, 'password');
        $client->request('PUT', '/api/items/'.$item->getId(), [
            'json' => [
                'level' => 20
            ]
        ]);
        $this->assertResponseStatusCodeSame(403);

        // test not found
        $this->createUserAdminAndLogin($client, 'password');
        $client->request('PUT', '/api/items/test', [
            'json' => [
                'level' => 20
            ]
        ]);
        $this->assertResponseStatusCodeSame(404);

        // test successful update
        $client->request('PUT', '/api/items/'.$item->getId(), [
            'json' => [
                'level' => 20
            ]
        ]);
        $this->assertResponseStatusCodeSame(200);
        ItemFactory::assert()->exists([
            'level' => 20
        ]);
    }

    public function testDeleteItem()
    {
        $item = ItemFactory::createOne();

        self::ensureKernelShutdown();
        $client = self::createClient();

        $this->testNotLoggedInUnauthorized($client, 'DELETE', '/api/items/'.$item->getId());

        // test forbidden
        $this->createUserAndLogin($client, 'password');
        $client->request('DELETE', '/api/items/'.$item->getId());
        $this->assertResponseStatusCodeSame(403);

        // test not found
        $this->createUserAdminAndLogin($client, 'password');
        $client->request('DELETE', '/api/items/test');
        $this->assertResponseStatusCodeSame(404);

        // test successful delete
        $client->request('DELETE', '/api/items/'.$item->getId());
        $this->assertResponseStatusCodeSame(204);
    }
}
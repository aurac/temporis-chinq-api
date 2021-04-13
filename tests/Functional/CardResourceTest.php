<?php
/**
 * CardResourceTest.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 05/04/2021
 *
 * @version 1.0
 */

namespace App\Tests\Functional;


use App\Factory\CardFactory;
use App\Factory\CardTypeFactory;
use App\Test\CustomApiTestCase;

/**
 * Class CardResourceTest
 * @package App\Tests\Functional
 * @group cards
 */
class CardResourceTest extends CustomApiTestCase
{
    public function testGetCollectionCard()
    {
        $client = self::createClient();

        // test not logged in, unauthorized
        $this->testNotLoggedInUnauthorized($client, 'GET', '/api/cards');

        // test logged in, success
        $this->createUserAndLogin($client, 'password');
        $client->request('GET', '/api/cards');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetItemCard()
    {
        $card = CardFactory::createOne();

        self::ensureKernelShutdown();
        $client = self::createClient();

        // test not logged in, unauthorized
        $this->testNotLoggedInUnauthorized($client, 'GET', '/api/cards/'.$card->getId());

        $this->createUserAndLogin($client, 'password');

        // test not found
        $client->request('GET', '/api/cards/test');
        $this->assertResponseStatusCodeSame(404);

        // test success
        $client->request('GET', '/api/cards/'.$card->getId());
        $this->assertResponseStatusCodeSame(200);
    }

    public function testCreateCard()
    {
        $cardType = CardTypeFactory::createOne();

        self::ensureKernelShutdown();
        $client = self::createClient();

        // test not logged in, unauthorized
        $this->testNotLoggedInUnauthorized($client, 'POST', '/api/cards');

        // test forbidden
        $this->createUserAndLogin($client, 'password');
        $client->request('POST', '/api/cards', [
            'json' => []
        ]);
        $this->assertResponseStatusCodeSame(403);

        // test missing data
        $this->createUserAdminAndLogin($client, 'password');
        $client->request('POST', '/api/cards', [
            'json' => []
        ]);
        $this->assertResponseStatusCodeSame(422);

        // test created success
        $client->request('POST', '/api/cards', [
            'json' => [
                'type' => '/api/card_types/'.$cardType->getId(),
                'name' => 'Card test',
                'level' => 10,
                'description' => '',
            ]
        ]);
        $this->assertResponseStatusCodeSame(201);
        CardFactory::assert()->exists([
            'name' => 'Card test',
            'level' => 10,
        ]);
    }

    public function testUpdateCard()
    {
        $card = CardFactory::createOne();

        self::ensureKernelShutdown();
        $client = self::createClient();

        $this->testNotLoggedInUnauthorized($client, 'PUT', '/api/cards/'.$card->getId());

        // test forbidden
        $this->createUserAndLogin($client, 'password');
        $client->request('PUT', '/api/cards/'.$card->getId(), [
            'json' => [
                'description' => 'New card description'
            ]
        ]);
        $this->assertResponseStatusCodeSame(403);

        // test not found
        $this->createUserAdminAndLogin($client, 'password');
        $client->request('PUT', '/api/cards/test', [
            'json' => [
                'description' => 'New card description'
            ]
        ]);
        $this->assertResponseStatusCodeSame(404);

        // test successful update
        $client->request('PUT', '/api/cards/'.$card->getId(), [
            'json' => [
                'description' => 'New card description'
            ]
        ]);
        $this->assertResponseStatusCodeSame(200);
    }

    public function testDeleteCard()
    {
        $card = CardFactory::createOne();

        self::ensureKernelShutdown();
        $client = self::createClient();

        $this->testNotLoggedInUnauthorized($client, 'DELETE', '/api/cards/'.$card->getId());

        // test forbidden
        $this->createUserAndLogin($client, 'password');
        $client->request('DELETE', '/api/cards/'.$card->getId());
        $this->assertResponseStatusCodeSame(403);

        // test not found
        $this->createUserAdminAndLogin($client, 'password');
        $client->request('DELETE', '/api/cards/test');
        $this->assertResponseStatusCodeSame(404);

        // test successful delete
        $client->request('DELETE', '/api/cards/'.$card->getId());
        $this->assertResponseStatusCodeSame(204);
    }
}
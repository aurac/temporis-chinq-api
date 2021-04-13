<?php
/**
 * RecipeResourceTest.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 10/04/2021
 *
 * @version 1.0
 */

namespace App\Tests\Functional;


use App\Factory\CardFactory;
use App\Factory\RecipeFactory;
use App\Factory\ItemFactory;
use App\Test\CustomApiTestCase;

/**
 * Class RecipeResourceTest
 * @package App\Tests\Functional
 * @group recipes
 */
class RecipeResourceTest extends CustomApiTestCase
{
    public function testGetCollectionRecipe()
    {
        $client = self::createClient();

        // test not logged in, unauthorized
        $this->testNotLoggedInUnauthorized($client, 'GET', '/api/recipes');

        // test logged in, success
        $this->createUserAndLogin($client, 'password');
        $client->request('GET', '/api/recipes');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetItemRecipe()
    {
        $recipe = RecipeFactory::createOne();

        self::ensureKernelShutdown();
        $client = self::createClient();

        // test not logged in, unauthorized
        $this->testNotLoggedInUnauthorized($client, 'GET', '/api/recipes/'.$recipe->getId());

        $this->createUserAndLogin($client, 'password');

        // test not found
        $client->request('GET', '/api/recipes/test');
        $this->assertResponseStatusCodeSame(404);

        // test success
        $client->request('GET', '/api/recipes/'.$recipe->getId());
        $this->assertResponseStatusCodeSame(200);
    }
    
    public function testCreateRecipe()
    {
        $client = self::createClient();

        $item = ItemFactory::new()->createOne();
        $cards = CardFactory::createMany(10);

        // test not logged in, unauthorized
        $this->testNotLoggedInUnauthorized($client, 'POST', '/api/recipes');

        $user = $this->createUserAndLogin($client, 'password');
        // test missing data
        $client->request('POST', '/api/recipes', [
            'json' => [
            ]
        ]);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertResponseStatusCodeSame(422);

        // test less than 5 cards
        $client->request('POST', '/api/recipes', [
            'json' => [
                'item' => '/api/items/'.$item->getId(),
                'cards' => [
                    '/api/cards/'.$cards[0]->getId(),
                ]
            ]
        ]);
        $this->assertResponseStatusCodeSame(422);

        // test more than 5 cards
        $client->request('POST', '/api/recipes', [
            'json' => [
                'item' => '/api/items/'.$item->getId(),
                'cards' => [
                    '/api/cards/'.$cards[0]->getId(),
                    '/api/cards/'.$cards[1]->getId(),
                    '/api/cards/'.$cards[2]->getId(),
                    '/api/cards/'.$cards[3]->getId(),
                    '/api/cards/'.$cards[4]->getId(),
                    '/api/cards/'.$cards[5]->getId(),
                    '/api/cards/'.$cards[6]->getId(),
                    '/api/cards/'.$cards[7]->getId(),
                    '/api/cards/'.$cards[8]->getId(),
                    '/api/cards/'.$cards[9]->getId(),
                ]
            ]
        ]);
        $this->assertResponseStatusCodeSame(422);

        // test created success and createdBy
        $client->request('POST', '/api/recipes', [
            'json' => [
                'item' => '/api/items/'.$item->getId(),
                'cards' => [
                    '/api/cards/'.$cards[0]->getId(),
                    '/api/cards/'.$cards[1]->getId(),
                    '/api/cards/'.$cards[2]->getId(),
                    '/api/cards/'.$cards[3]->getId(),
                    '/api/cards/'.$cards[4]->getId(),
                ]
            ]
        ]);
        $this->assertResponseStatusCodeSame(201);
        RecipeFactory::assert()->exists([
            'createdBy' => $user
        ]);
    }

    public function testUpdateRecipe()
    {
        $client = self::createClient();

        $item = ItemFactory::new()->createOne();
        $cards = CardFactory::createMany(5);
        $recipe = RecipeFactory::new([
            'item' => $item,
            'cards' => $cards
        ])->createOne();
        $newCard = CardFactory::createOne();

        // test not logged in, unauthorized
        $this->testNotLoggedInUnauthorized($client, 'PUT', '/api/recipes/'.$recipe->getId());

        $user = $this->createUserAndLogin($client, 'password');
        // test missing data
        $client->request('PUT', '/api/recipes/'.$recipe->getId(), [
            'json' => [
            ]
        ]);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertResponseStatusCodeSame(422);

        // test less than 5 cards
        $client->request('PUT', '/api/recipes/'.$recipe->getId(), [
            'json' => [
                'cards' => [
                    '/api/cards/'.$cards[0]->getId(),
                ]
            ]
        ]);
        $this->assertResponseStatusCodeSame(422);

        // test more than 5 cards
        $client->request('PUT', '/api/recipes/'.$recipe->getId(), [
            'json' => [
                'cards' => [
                    '/api/cards/'.$cards[0]->getId(),
                    '/api/cards/'.$cards[1]->getId(),
                    '/api/cards/'.$cards[2]->getId(),
                    '/api/cards/'.$cards[3]->getId(),
                    '/api/cards/'.$cards[4]->getId(),
                    '/api/cards/'.$newCard->getId(),
                ]
            ]
        ]);
        $this->assertResponseStatusCodeSame(422);

        // test created success and createdBy
        $client->request('PUT', '/api/recipes/'.$recipe->getId(), [
            'json' => [
                'cards' => [
                    '/api/cards/'.$cards[0]->getId(),
                    '/api/cards/'.$cards[1]->getId(),
                    '/api/cards/'.$cards[2]->getId(),
                    '/api/cards/'.$cards[3]->getId(),
                    '/api/cards/'.$newCard->getId(),
                ]
            ]
        ]);
        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains(['cards' => [4 => ['id' => $newCard->getId()]]]);
        RecipeFactory::assert()->exists([
            'updatedBy' => $user
        ]);
    }

    public function testDeleteRecipe()
    {
        $recipe = RecipeFactory::createOne();

        self::ensureKernelShutdown();
        $client = self::createClient();

        $this->testNotLoggedInUnauthorized($client, 'DELETE', '/api/recipes/'.$recipe->getId());

        // test forbidden
        $this->createUserAndLogin($client, 'password');
        $client->request('DELETE', '/api/recipes/'.$recipe->getId());
        $this->assertResponseStatusCodeSame(403);

        // test not found
        $this->createUserAdminAndLogin($client, 'password');
        $client->request('DELETE', '/api/recipes/test');
        $this->assertResponseStatusCodeSame(404);

        // test successful delete
        $client->request('DELETE', '/api/recipes/'.$recipe->getId());
        $this->assertResponseStatusCodeSame(204);
    }
}
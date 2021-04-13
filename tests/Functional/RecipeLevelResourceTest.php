<?php
/**
 * RecipeLevelResourceTest.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 10/04/2021
 *
 * @version 1.0
 */

namespace App\Tests\Functional;

use App\Factory\CardFactory;
use App\Factory\RecipeLevelFactory;
use App\Test\CustomApiTestCase;

/**
 * Class RecipeLevelResourceTest
 * @package App\Tests\Functional
 * @group recipe_levels
 */
class RecipeLevelResourceTest extends CustomApiTestCase
{
    public function testGetCollectionRecipeLevel()
    {
        $client = self::createClient();

        // test not logged in, unauthorized
        $this->testNotLoggedInUnauthorized($client, 'GET', '/api/recipe_levels');

        // test logged in, success
        $this->createUserAndLogin($client, 'password');
        $client->request('GET', '/api/recipe_levels');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetItemRecipeLevel()
    {
        $recipeLevel = RecipeLevelFactory::createOne();

        self::ensureKernelShutdown();
        $client = self::createClient();

        // test not logged in, unauthorized
        $this->testNotLoggedInUnauthorized($client, 'GET', '/api/recipe_levels/'.$recipeLevel->getId());

        $this->createUserAndLogin($client, 'password');

        // test not found
        $client->request('GET', '/api/recipe_levels/test');
        $this->assertResponseStatusCodeSame(404);

        // test success
        $client->request('GET', '/api/recipe_levels/'.$recipeLevel->getId());
        $this->assertResponseStatusCodeSame(200);
    }

    public function testCreateRecipeLevel()
    {
        $client = self::createClient();

        $cards = CardFactory::createMany(10);

        // test not logged in, unauthorized
        $this->testNotLoggedInUnauthorized($client, 'POST', '/api/recipe_levels');

        // test forbidden
        $this->createUserAndLogin($client, 'password');
        $client->request('POST', '/api/recipe_levels', [
            'json' => [
                'level' => 10,
                'cards' => [
                    '/api/cards/'.$cards[0]->getId(),
                    '/api/cards/'.$cards[1]->getId(),
                    '/api/cards/'.$cards[2]->getId(),
                    '/api/cards/'.$cards[3]->getId(),
                    '/api/cards/'.$cards[4]->getId(),
                ]
            ]
        ]);
        $this->assertResponseStatusCodeSame(403);

        // test missing data
        $this->createUserAdminAndLogin($client, 'password');
        $client->request('POST', '/api/recipe_levels', [
            'json' => []
        ]);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertResponseStatusCodeSame(422);

        // test less than 5 cards
        $client->request('POST', '/api/recipe_levels', [
            'json' => [
                'cards' => [
                    '/api/cards/'.$cards[0]->getId(),
                ]
            ]
        ]);
        $this->assertResponseStatusCodeSame(422);

        // test more than 5 cards
        $client->request('POST', '/api/recipe_levels', [
            'json' => [
                'level' => 10,
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
        $client->request('POST', '/api/recipe_levels', [
            'json' => [
                'level' => 10,
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
    }

    public function testUpdateRecipe()
    {
        $client = self::createClient();

        $cards = CardFactory::createMany(5);
        $recipeLevel = RecipeLevelFactory::new([
            'cards' => $cards
        ])->createOne();
        $newCard = CardFactory::createOne();

        // test not logged in, unauthorized
        $this->testNotLoggedInUnauthorized($client, 'PUT', '/api/recipe_levels/'.$recipeLevel->getId());

        $user = $this->createUserAndLogin($client, 'password');
        // test missing data
        $client->request('PUT', '/api/recipe_levels/'.$recipeLevel->getId(), [
            'json' => [
            ]
        ]);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertResponseStatusCodeSame(422);

        // test less than 5 cards
        $client->request('PUT', '/api/recipe_levels/'.$recipeLevel->getId(), [
            'json' => [
                'cards' => [
                    '/api/cards/'.$cards[0]->getId(),
                ]
            ]
        ]);
        $this->assertResponseStatusCodeSame(422);

        // test more than 5 cards
        $client->request('PUT', '/api/recipe_levels/'.$recipeLevel->getId(), [
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
        $client->request('PUT', '/api/recipe_levels/'.$recipeLevel->getId(), [
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
        RecipeLevelFactory::assert()->exists([
            'updatedBy' => $user
        ]);
    }

    public function testDeleteRecipeLevel()
    {
        $recipeLevel = RecipeLevelFactory::createOne();

        self::ensureKernelShutdown();
        $client = self::createClient();

        $this->testNotLoggedInUnauthorized($client, 'DELETE', '/api/recipe_levels/'.$recipeLevel->getId());

        // test forbidden
        $this->createUserAndLogin($client, 'password');
        $client->request('DELETE', '/api/recipe_levels/'.$recipeLevel->getId());
        $this->assertResponseStatusCodeSame(403);

        // test not found
        $this->createUserAdminAndLogin($client, 'password');
        $client->request('DELETE', '/api/recipe_levels/test');
        $this->assertResponseStatusCodeSame(404);

        // test successful delete
        $client->request('DELETE', '/api/recipe_levels/'.$recipeLevel->getId());
        $this->assertResponseStatusCodeSame(204);
    }
}
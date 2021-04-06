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


use App\Entity\Card;
use App\Test\CustomApiTestCase;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;

class CardResourceTest extends CustomApiTestCase
{
    use ReloadDatabaseTrait;

    public function testCreateCard()
    {
        $client = self::createClient();

        $client->request('POST', '/api/cards');
        $this->assertResponseStatusCodeSame(401);

        $this->createUserAndLogin($client, 'test@test.fr', 'password');

        $client->request('POST', '/api/cards', [
            'json' => []
        ]);

        $this->assertResponseStatusCodeSame(403);

        $this->createUserAdminAndLogin($client, 'admin@admin.fr', 'password');

        $client->request('POST', '/api/cards', [
            'json' => []
        ]);

        $this->assertResponseStatusCodeSame(422);
    }

    public function testUpdateCard()
    {
        $client = self::createClient();
        $user1 = $this->createUser('user1@test.fr', 'password');
        $user2 = $this->createUserAdmin('user2@test.fr', 'password');

        $card = new Card();
        $card->setName('Card test')
            ->setLevel(10)
            ->setDescription('Card description test')
        ;

        $em = $this->getEntityManager();
        $em->persist($card);
        $em->flush();

        $this->login($client, 'user1@test.fr', 'password');

        $client->request('PUT', '/api/cards/'.$card->getId(), [
            'json' => [
                'description' => 'New card description'
            ]
        ]);

        $this->assertResponseStatusCodeSame(403);

        $this->login($client, 'user2@test.fr', 'password');

        $client->request('PUT', '/api/cards/'.$card->getId(), [
            'json' => [
                'description' => 'New card description'
            ]
        ]);

        $this->assertResponseStatusCodeSame(200);
    }
}
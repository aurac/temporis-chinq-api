<?php
/**
 * CardFixtures.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 02/04/2021
 *
 * @version 1.0
 */

namespace App\DataFixtures;

use App\Entity\Card;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class CardFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        $nbCards = 100;

        for ($i = 1; $i <= $nbCards; $i++) {
            $card = $this->createCard('carte'.$i, $i, rand(1,200), 'description carte '.$i);
            $manager->persist($card);
        }

        $manager->flush();
    }

    private function createCard(string $name, int $number, int $level, string $description): Card
    {
        $card = new Card();
        $card->setName($name)
            ->setNumber($number)
            ->setLevel($level)
            ->setDescription($description)
        ;
        return $card;
    }

    public static function getGroups(): array
    {
        return ['cards'];
    }
}
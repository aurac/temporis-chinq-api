<?php
/**
 * TypeFixtures.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 31/03/2021
 *
 * @version 1.0
 */

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    const TYPE_CONSUMABLE = 'consumable';
    const TYPE_STUFF = 'stuff';

    public function load(ObjectManager $manager)
    {
        $type = $this->createType(self::TYPE_STUFF);
        $manager->persist($type);

        $this->addReference(self::TYPE_STUFF, $type);

        $type = $this->createType(self::TYPE_CONSUMABLE);
        $manager->persist($type);

        $this->addReference(self::TYPE_CONSUMABLE, $type);

        $manager->flush();
    }

    private function createType(string $name): Type
    {
        $type = new Type();
        $type->setName($name);
        return $type;
    }
}
<?php
/**
 * SubTypeFixtures.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 31/03/2021
 *
 * @version 1.0
 */

namespace App\DataFixtures;

use App\Entity\SubType;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SubTypeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getSubTypes() as $type => $subTypes) {
            /** @var Type $type */
            $type = $this->getReference($type);
            foreach ($subTypes as $subType) {
                $subType = $this->createSubType($subType, $type);
                $manager->persist($subType);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TypeFixtures::class,
        ];
    }

    private function createSubType(string $name, Type $type): SubType
    {
        $subType = new SubType();
        $subType->setName($name)
            ->setType($type)
        ;

        return $subType;
    }

    private function getSubTypes(): array
    {
        return [
            TypeFixtures::TYPE_CONSUMABLE => [
                'beer',
                'drink',
                'kamas_purse',
                'fragments_box',
                'chest',
                'container',
                'confection',
                'fairy_fireworks',
                'mimibiote',
                'haiku_words',
                'breeding_object',
                'usable_object',
                'bread',
                'attitude_scroll',
                'experience_scroll',
                'ornamental_scroll',
                'emoticons_scroll',
                'trait_scroll',
                'research_scroll',
                'spell_scroll',
                'title_scroll',
                'magic_stone',
                'edible_fish',
                'havre_sac_popoche',
                'potion',
                'attitude_potion',
                'perceptor_oblivion_potion',
                'conquest_potion',
                'familiar_potion',
                'hilltop_potion',
                'mount_potion',
                'teleportation_potion',
                'edible_meat',
            ],
            TypeFixtures::TYPE_STUFF => [
                'bow',
                'dagger',
                'hammer',
                'pickaxe',
                'scythe',
                'shovel',
                'soulstone',
                'sword',
                'tool',
                'amulet',
                'bagpack',
                'belt',
                'boots',
                'cap',
                'helmet',
                'ring',
                'dofus',
                'trophy'
            ]
        ];
    }
}
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

                'Bière',
                'Boisson',
                'Bourse de Kamas',
                'Boîte de fragments',
                'Coffre',
                'Conteneur',
                'Friandise',
                'Fée d\'artifice',
                'Mimibiote',
                'Mots de haïku',
                'Objet d\'élevage',
                'Objet utilisable',
                'Pain',
                'Parchemin d\'attitude',
                'Parchemin d\'expérience',
                'Parchemin d\'ornement',
                'Parchemin d\'émoticônes',
                'Parchemin de caractéristique',
                'Parchemin de recherche',
                'Parchemin de sortilège',
                'Parchemin de titre',
                'Pierre magique',
                'Poisson comestible',
                'Popoche de Havre-Sac',
                'Potion',
                'Potion d\'attitude',
                'Potion d\'oubli Percepteur',
                'Potion de conquête',
                'Potion de familier',
                'Potion de montilier',
                'Potion de monture',
                'Potion de téléportation',
                'Viande comestible ',
            ],
            TypeFixtures::TYPE_STUFF => [
                'Arc',
                'Baguette',
                'Bâton',
                'Dague',
                'Faux',
                'Hache',
                'Marteau',
                'Outil',
                'Pelle',
                'Pierre d\'âme',
                'Pioche',
                'Épée',
                'Amulette',
                'Anneau',
                'Bottes',
                'Bouclier',
                'Cape',
                'Ceinture',
                'Chapeau',
                'Dofus',
                'Objet vivant',
                'Sac à dos',
                'Trophée',
            ],
            TypeFixtures::TYPE_RESOURCE => [
                'Idole'
            ]
        ];
    }
}
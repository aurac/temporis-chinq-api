<?php
/**
 * RecipeLevelFixtures.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 02/04/2021
 *
 * @version 1.0
 */

namespace App\DataFixtures;

use App\Entity\RecipeLevel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class RecipeLevelFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        $nb = 200;

        for ($i = 2; $i <= $nb; $i++) {
            $recipeLevel = $this->createRecipeLevel($i);
            $manager->persist($recipeLevel);
        }

        $manager->flush();
    }

    private function createRecipeLevel(int $level): RecipeLevel
    {
        $recipeLevel = new RecipeLevel();
        $recipeLevel->setLevel($level);
        return $recipeLevel;
    }

    public static function getGroups(): array
    {
        return ['recipe_levels'];
    }
}
<?php

namespace App\Factory;

use App\Entity\RecipeLevel;
use App\Repository\RecipeLevelRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static RecipeLevel|Proxy createOne(array $attributes = [])
 * @method static RecipeLevel[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static RecipeLevel|Proxy find($criteria)
 * @method static RecipeLevel|Proxy findOrCreate(array $attributes)
 * @method static RecipeLevel|Proxy first(string $sortedField = 'id')
 * @method static RecipeLevel|Proxy last(string $sortedField = 'id')
 * @method static RecipeLevel|Proxy random(array $attributes = [])
 * @method static RecipeLevel|Proxy randomOrCreate(array $attributes = [])
 * @method static RecipeLevel[]|Proxy[] all()
 * @method static RecipeLevel[]|Proxy[] findBy(array $attributes)
 * @method static RecipeLevel[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static RecipeLevel[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static RecipeLevelRepository|RepositoryProxy repository()
 * @method RecipeLevel|Proxy create($attributes = [])
 */
final class RecipeLevelFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'level' => self::faker()->unique()->numberBetween(1, 200),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(RecipeLevel $recipeLevel) {})
        ;
    }

    protected static function getClass(): string
    {
        return RecipeLevel::class;
    }
}

<?php

namespace App\Factory;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Recipe|Proxy createOne(array $attributes = [])
 * @method static Recipe[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Recipe|Proxy find($criteria)
 * @method static Recipe|Proxy findOrCreate(array $attributes)
 * @method static Recipe|Proxy first(string $sortedField = 'id')
 * @method static Recipe|Proxy last(string $sortedField = 'id')
 * @method static Recipe|Proxy random(array $attributes = [])
 * @method static Recipe|Proxy randomOrCreate(array $attributes = [])
 * @method static Recipe[]|Proxy[] all()
 * @method static Recipe[]|Proxy[] findBy(array $attributes)
 * @method static Recipe[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Recipe[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static RecipeRepository|RepositoryProxy repository()
 * @method Recipe|Proxy create($attributes = [])
 */
final class RecipeFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'item' => ItemFactory::new()
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Recipe $recipe) {})
        ;
    }

    protected static function getClass(): string
    {
        return Recipe::class;
    }
}

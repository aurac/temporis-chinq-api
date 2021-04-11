<?php

namespace App\Factory;

use App\Entity\Rarity;
use App\Repository\RarityRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Rarity|Proxy createOne(array $attributes = [])
 * @method static Rarity[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Rarity|Proxy find($criteria)
 * @method static Rarity|Proxy findOrCreate(array $attributes)
 * @method static Rarity|Proxy first(string $sortedField = 'id')
 * @method static Rarity|Proxy last(string $sortedField = 'id')
 * @method static Rarity|Proxy random(array $attributes = [])
 * @method static Rarity|Proxy randomOrCreate(array $attributes = [])
 * @method static Rarity[]|Proxy[] all()
 * @method static Rarity[]|Proxy[] findBy(array $attributes)
 * @method static Rarity[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Rarity[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static RarityRepository|RepositoryProxy repository()
 * @method Rarity|Proxy create($attributes = [])
 */
final class RarityFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->realTextBetween(5, 25),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Rarity $rarity) {})
        ;
    }

    protected static function getClass(): string
    {
        return Rarity::class;
    }
}

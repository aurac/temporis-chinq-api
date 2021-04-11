<?php

namespace App\Factory;

use App\Entity\Item;
use App\Repository\ItemRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Item|Proxy createOne(array $attributes = [])
 * @method static Item[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Item|Proxy find($criteria)
 * @method static Item|Proxy findOrCreate(array $attributes)
 * @method static Item|Proxy first(string $sortedField = 'id')
 * @method static Item|Proxy last(string $sortedField = 'id')
 * @method static Item|Proxy random(array $attributes = [])
 * @method static Item|Proxy randomOrCreate(array $attributes = [])
 * @method static Item[]|Proxy[] all()
 * @method static Item[]|Proxy[] findBy(array $attributes)
 * @method static Item[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Item[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ItemRepository|RepositoryProxy repository()
 * @method Item|Proxy create($attributes = [])
 */
final class ItemFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'subType' => SubTypeFactory::createOne(),
            'name' => self::faker()->realTextBetween(5, 25),
            'level' => self::faker()->numberBetween(1, 200),
            'link' => self::faker()->url(),
            'imgLink' => self::faker()->imageUrl(100, 100, 'animals', true)
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Item $item) {})
        ;
    }

    protected static function getClass(): string
    {
        return Item::class;
    }
}

<?php

namespace App\Factory;

use App\Entity\CardType;
use App\Repository\CardTypeRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static CardType|Proxy createOne(array $attributes = [])
 * @method static CardType[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static CardType|Proxy find($criteria)
 * @method static CardType|Proxy findOrCreate(array $attributes)
 * @method static CardType|Proxy first(string $sortedField = 'id')
 * @method static CardType|Proxy last(string $sortedField = 'id')
 * @method static CardType|Proxy random(array $attributes = [])
 * @method static CardType|Proxy randomOrCreate(array $attributes = [])
 * @method static CardType[]|Proxy[] all()
 * @method static CardType[]|Proxy[] findBy(array $attributes)
 * @method static CardType[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static CardType[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CardTypeRepository|RepositoryProxy repository()
 * @method CardType|Proxy create($attributes = [])
 */
final class CardTypeFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->realTextBetween(5, 25)
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(CardType $cardType) {})
        ;
    }

    protected static function getClass(): string
    {
        return CardType::class;
    }
}

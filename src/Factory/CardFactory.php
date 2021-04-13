<?php

namespace App\Factory;

use App\Entity\Card;
use App\Repository\CardRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Card|Proxy createOne(array $attributes = [])
 * @method static Card[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Card|Proxy find($criteria)
 * @method static Card|Proxy findOrCreate(array $attributes)
 * @method static Card|Proxy first(string $sortedField = 'id')
 * @method static Card|Proxy last(string $sortedField = 'id')
 * @method static Card|Proxy random(array $attributes = [])
 * @method static Card|Proxy randomOrCreate(array $attributes = [])
 * @method static Card[]|Proxy[] all()
 * @method static Card[]|Proxy[] findBy(array $attributes)
 * @method static Card[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Card[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CardRepository|RepositoryProxy repository()
 * @method Card|Proxy create($attributes = [])
 */
final class CardFactory extends ModelFactory
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
            'level' => self::faker()->numberBetween(1, 200),
            'description' => self::faker()->realTextBetween(15, 50),
            'type' => CardTypeFactory::createOne(),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Card $card) {})
        ;
    }

    protected static function getClass(): string
    {
        return Card::class;
    }
}

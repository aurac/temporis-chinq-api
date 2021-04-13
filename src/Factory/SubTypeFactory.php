<?php

namespace App\Factory;

use App\Entity\SubType;
use App\Repository\SubTypeRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static SubType|Proxy createOne(array $attributes = [])
 * @method static SubType[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static SubType|Proxy find($criteria)
 * @method static SubType|Proxy findOrCreate(array $attributes)
 * @method static SubType|Proxy first(string $sortedField = 'id')
 * @method static SubType|Proxy last(string $sortedField = 'id')
 * @method static SubType|Proxy random(array $attributes = [])
 * @method static SubType|Proxy randomOrCreate(array $attributes = [])
 * @method static SubType[]|Proxy[] all()
 * @method static SubType[]|Proxy[] findBy(array $attributes)
 * @method static SubType[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static SubType[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static SubTypeRepository|RepositoryProxy repository()
 * @method SubType|Proxy create($attributes = [])
 */
final class SubTypeFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'type' => TypeFactory::createOne(),
            'name' => self::faker()->realText(15)
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(SubType $subType) {})
        ;
    }

    protected static function getClass(): string
    {
        return SubType::class;
    }
}

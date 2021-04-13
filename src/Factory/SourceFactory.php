<?php

namespace App\Factory;

use App\Entity\Source;
use App\Repository\SourceRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Source|Proxy createOne(array $attributes = [])
 * @method static Source[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Source|Proxy find($criteria)
 * @method static Source|Proxy findOrCreate(array $attributes)
 * @method static Source|Proxy first(string $sortedField = 'id')
 * @method static Source|Proxy last(string $sortedField = 'id')
 * @method static Source|Proxy random(array $attributes = [])
 * @method static Source|Proxy randomOrCreate(array $attributes = [])
 * @method static Source[]|Proxy[] all()
 * @method static Source[]|Proxy[] findBy(array $attributes)
 * @method static Source[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Source[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static SourceRepository|RepositoryProxy repository()
 * @method Source|Proxy create($attributes = [])
 */
final class SourceFactory extends ModelFactory
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
            // ->afterInstantiate(function(Source $source) {})
        ;
    }

    protected static function getClass(): string
    {
        return Source::class;
    }
}

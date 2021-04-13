<?php

namespace App\Factory;

use App\Entity\MediaObject;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static MediaObject|Proxy createOne(array $attributes = [])
 * @method static MediaObject[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static MediaObject|Proxy find($criteria)
 * @method static MediaObject|Proxy findOrCreate(array $attributes)
 * @method static MediaObject|Proxy first(string $sortedField = 'id')
 * @method static MediaObject|Proxy last(string $sortedField = 'id')
 * @method static MediaObject|Proxy random(array $attributes = [])
 * @method static MediaObject|Proxy randomOrCreate(array $attributes = [])
 * @method static MediaObject[]|Proxy[] all()
 * @method static MediaObject[]|Proxy[] findBy(array $attributes)
 * @method static MediaObject[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static MediaObject[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method MediaObject|Proxy create($attributes = [])
 */
final class MediaObjectFactory extends ModelFactory
{
    private string $uploadDir;

    public function __construct(string $uploadDir)
    {
        parent::__construct();
        $this->uploadDir = $uploadDir;
    }

    protected function getDefaults(): array
    {
        return [
            'filePath' => self::faker()->image($this->uploadDir.'/images/', 100, 100, 'animals'),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(MediaObject $mediaObject) {})
        ;
    }

    protected static function getClass(): string
    {
        return MediaObject::class;
    }
}

<?php
/**
 * RecipeSearchFilter.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 07/04/2021
 *
 * @version 1.0
 */

namespace App\Filter;


use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;

class RecipeSearchFilter extends AbstractFilter
{
    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        if ($property !== 'cards') {
            return;
        }

        $alias = $queryBuilder->getRootAliases()[0];
        $i = 0;
        foreach ($value as $v) {
            if (!$v) {
                continue;
            }
            $queryBuilder->innerJoin($alias.'.cards', 'c'.$i.'_');
            $queryBuilder->andWhere(sprintf('%s.id = :value'.$i, 'c'.$i.'_'));
            $queryBuilder->setParameter('value'.$i, $v);
            $i++;
        }
    }

    public function getDescription(string $resourceClass): array
    {
        return [
            'cards[]' => [
                'property' => null,
                'type' => 'int',
                'required' => false,
                'is_collection' => true
            ]
        ];
    }
}
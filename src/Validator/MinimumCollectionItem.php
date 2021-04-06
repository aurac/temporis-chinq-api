<?php
/**
 * MinimumCollectionItem.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 06/04/2021
 *
 * @version 1.0
 */

namespace App\Validator;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "ANNOTATION"})
 */
class MinimumCollectionItem extends Constraint
{
    public string $message = 'Collection cannot contain less than "{{ compared_value }}" items';
    public int $min;
}
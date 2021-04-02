<?php
/**
 * MaximumCollectionItem.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 02/04/2021
 *
 * @version 1.0
 */

namespace App\Validator;


use Symfony\Component\Validator\Constraint;
/**
 * @Annotation
 * @Target({"PROPERTY", "ANNOTATION"})
 */
class MaximumCollectionItem extends Constraint
{
    public $message = 'Collection cannot contain more than "{{ compared_value }}" items';
    public $max;
}
<?php
/**
 * MaximumCollectionItemValidator.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 02/04/2021
 *
 * @version 1.0
 */

namespace App\Validator;


use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class MaximumCollectionItemValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof MaximumCollectionItem) {
            throw new UnexpectedTypeException($constraint, MaximumCollectionItem::class);
        }

        if (null === $value) {
            return;
        }

        if (!$value instanceof Collection) {
            throw new UnexpectedValueException($value, Collection::class);
        }

        if (count($value) > $constraint->max) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ compared_value }}', $constraint->max)
                ->addViolation();
        }
    }
}
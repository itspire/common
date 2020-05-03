<?php

/**
 * Copyright (c) 2016 - 2019 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Validator;

use Itspire\Common\Enumeration\AbstractEnumeration;
use Itspire\Common\Validator\Constraints\Enumeration;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class EnumerationValidator extends ConstraintValidator
{
    /** @param AbstractEnumeration|null $value */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof Enumeration) {
            throw new UnexpectedTypeException($constraint, Enumeration::class);
        }

        if (null === $value || !in_array($value, ($constraint->enumerationClass)::getValues(), false)) {
            $this->context
                ->buildViolation(null === $value ? $constraint::NULL_VALUE : $constraint::INVALID_VALUE)
                ->setParameter('{{ field }}', $this->context->getPropertyName())
                ->addViolation();
        }
    }
}

<?php

/*
 * Copyright (c) 2016 - 2022 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Enum\Validator;

use Itspire\Common\Enum\AbstractEnum;
use Itspire\Common\Enum\Validator\Constraint\Enum;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/** @deprecated Will be removed in 3.0, use native php enums instead */
class EnumValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof Enum) {
            throw new UnexpectedTypeException($constraint, Enum::class);
        }

        if (null !== $value && !$value instanceof AbstractEnum) {
            throw new UnexpectedTypeException($value, AbstractEnum::class);
        }

        if (null === $value || !in_array($value, ($constraint->enumClass)::getValues(), false)) {
            $this->context
                ->buildViolation(null === $value ? $constraint::NULL_VALUE : $constraint::INVALID_VALUE)
                ->setParameter('{{ field }}', $this->context->getPropertyName())
                ->addViolation();
        }
    }
}

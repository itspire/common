<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Validator\Constraint;

use Itspire\Common\Enum\AbstractEnum;
use Itspire\Common\Enum\EnumInterface;
use Itspire\Common\Enum\Validator\Constraint\Enum;
use Itspire\Common\Enum\Validator\EnumValidator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Exception\ValidatorException;
use Itspire\Common\Tests\Fixtures\Enum\TestEnum;

class EnumTest extends TestCase
{
    /** @test */
    public function createEnumConstraintWithUnresolvableEnumClassTest(): void
    {
        $this->expectException(ValidatorException::class);
        $this->expectExceptionMessage('The option enumClass must be a valid class FQN : test provided');

        new Enum(['enumClass' => 'test']);
    }

    /** @test */
    public function createEnumConstraintWithInvalidEnumClassTest(): void
    {
        $this->expectException(ValidatorException::class);
        $this->expectExceptionMessage(
            'The option enumClass must be the name of a class that extends ' . AbstractEnum::class . '.'
        );

        new Enum(['enumClass' => EnumInterface::class]);
    }

    /** @test */
    public function createEnumConstraintTest(): void
    {
        $enumConstraint = new Enum(TestEnum::class);

        static::assertEquals(EnumValidator::class, $enumConstraint->validatedBy());
        static::assertEquals(['enumClass'], $enumConstraint->getRequiredOptions());
        static::assertEquals('enumClass', $enumConstraint->getDefaultOption());
    }
}

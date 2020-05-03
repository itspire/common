<?php

/**
 * Copyright (c) 2016 - 2019 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Validator\Constraints;

use Itspire\Common\Enumeration\AbstractEnumeration;
use Itspire\Common\Validator\Constraints\Enumeration;
use Itspire\Common\Validator\EnumerationValidator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Exception\ValidatorException;
use Itspire\Common\Enumeration\Interfaces\EnumerationInterface;
use Itspire\Common\Tests\Fixtures\TestEnumeration;

/**
 * @coversDefaultClass \Itspire\Common\Validator\Constraints\Enumeration
 * @covers ::__construct
 */
class EnumerationTest extends TestCase
{
    /** @test */
    public function createEnumerationConstraintWithUnresolvableEnumerationClassTest(): void
    {
        $this->expectException(ValidatorException::class);
        $this->expectExceptionMessage('The option enumerationClass must be a valid class FQN.');

        new Enumeration(['enumerationClass' => 'test']);
    }

    /** @test */
    public function createEnumerationConstraintWithInvalidEnumerationClassTest(): void
    {
        $this->expectException(ValidatorException::class);
        $this->expectExceptionMessage(
            'The option enumerationClass must be the name of a class that extends ' . AbstractEnumeration::class . '.'
        );

        new Enumeration(['enumerationClass' => EnumerationInterface::class]);
    }

    /**
     * @test
     * @covers ::validatedBy
     * @covers ::getRequiredOptions
     * @covers ::getDefaultOption
     */
    public function createEnumerationConstraintTest(): void
    {
        $enumConstraint = new Enumeration(TestEnumeration::class);

        static::assertEquals(EnumerationValidator::class, $enumConstraint->validatedBy());
        static::assertEquals(['enumerationClass'], $enumConstraint->getRequiredOptions());
        static::assertEquals('enumerationClass', $enumConstraint->getDefaultOption());
    }
}

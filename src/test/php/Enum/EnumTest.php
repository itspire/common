<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Enum;

use Itspire\Common\Tests\Fixtures\Enum\TestBusinessEnum;
use PHPUnit\Framework\TestCase;

class EnumTest extends TestCase
{
    /** @test */
    public function createEnumObjectWithInvalidArgumentTest(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Provided value is not valid : must be a valid constant value in ' . TestBusinessEnum::class . '.'
        );

        new TestBusinessEnum(10);
    }

    /** @test */
    public function createEnumObjectTest(): void
    {
        static::assertTrue((new TestBusinessEnum(TestBusinessEnum::TEST_VALUE_A))->getValue());
    }

    /** @test */
    public function getRawValuesTest(): void
    {
        static::assertEquals(
            [
                'TEST_VALUE_A' => TestBusinessEnum::TEST_VALUE_A,
                'TEST_VALUE_B' => TestBusinessEnum::TEST_VALUE_B,
                'TEST_VALUE_C' => TestBusinessEnum::TEST_VALUE_C,
                'TEST_VALUE_D' => TestBusinessEnum::TEST_VALUE_D,
                'TEST_VALUE_E' => TestBusinessEnum::TEST_VALUE_E,
            ],
            TestBusinessEnum::getRawValues()
        );
    }

    /** @test */
    public function getValuesTest(): void
    {
        static::assertEquals(
            [
                new TestBusinessEnum(TestBusinessEnum::TEST_VALUE_A),
                new TestBusinessEnum(TestBusinessEnum::TEST_VALUE_B),
                new TestBusinessEnum(TestBusinessEnum::TEST_VALUE_C),
                new TestBusinessEnum(TestBusinessEnum::TEST_VALUE_D),
                new TestBusinessEnum(TestBusinessEnum::TEST_VALUE_E),
            ],
            TestBusinessEnum::getValues()
        );
    }

    /** @test */
    public function resolveCodeInvalidArgumentTest(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('TEST_VALUE is not a valid code for ' . TestBusinessEnum::class . '.');

        TestBusinessEnum::resolveCode('TEST_VALUE');
    }

    /** @test */
    public function resolveCodeTest(): void
    {
        static::assertEquals(
            TestBusinessEnum::TEST_VALUE_D[0],
            (TestBusinessEnum::resolveCode('TEST_VALUE_D'))->getValue()
        );
    }

    /** @test */
    public function resolveValueInvalidArgumentTest(): void
    {

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('10 is not a valid value for ' . TestBusinessEnum::class . '.');

        TestBusinessEnum::resolveValue(10);
    }

    /** @test */
    public function resolveValueScalarValueTest(): void
    {
        $enum = TestBusinessEnum::resolveValue(2);

        static::assertEquals('TEST_VALUE_C', $enum->getCode());
        static::assertEquals('TEST_VALUE_C', $enum->getDescription());
    }

    /** @test */
    public function resolveValueArrayValueTest(): void
    {
        static::assertEquals(
            TestBusinessEnum::TEST_VALUE_D[1],
            (TestBusinessEnum::resolveValue('value'))->getDescription()
        );
    }

    /** @test */
    public function getScalarEnumTest(): void
    {
        $enum = new TestBusinessEnum(TestBusinessEnum::TEST_VALUE_A);

        static::assertEquals('TEST_VALUE_A', $enum->getCode());
        static::assertEquals($enum->getUniqueIdentifier(), $enum->getCode());
        static::assertEquals('TEST_VALUE_A', $enum->getDescription());
        static::assertTrue($enum->getValue());
    }

    /** @test */
    public function getArrayEnumTest(): void
    {
        $enum = new TestBusinessEnum(TestBusinessEnum::TEST_VALUE_D);

        static::assertEquals('TEST_VALUE_D', $enum->getCode());
        static::assertEquals('value', $enum->getValue());
        static::assertEquals('description', $enum->getDescription());
    }
}

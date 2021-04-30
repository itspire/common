<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Enum;

use Itspire\Common\Tests\Fixtures\Enum\TestEnum;
use PHPUnit\Framework\TestCase;

class EnumTest extends TestCase
{
    /** @test */
    public function createEnumObjectWithInvalidArgumentTest(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Provided value is not valid : must be a valid constant value in ' . TestEnum::class . '.'
        );

        new TestEnum(10);
    }

    /** @test */
    public function createEnumObjectTest(): void
    {
        static::assertTrue((new TestEnum(TestEnum::TEST_VALUE_A))->getValue());
    }

    /** @test */
    public function getRawValuesTest(): void
    {
        static::assertEquals(
            [
                'TEST_VALUE_A' => TestEnum::TEST_VALUE_A,
                'TEST_VALUE_B' => TestEnum::TEST_VALUE_B,
                'TEST_VALUE_C' => TestEnum::TEST_VALUE_C,
                'TEST_VALUE_D' => TestEnum::TEST_VALUE_D,
            ],
            TestEnum::getRawValues()
        );
    }

    /** @test */
    public function getValuesTest(): void
    {
        static::assertEquals(
            [
                new TestEnum(TestEnum::TEST_VALUE_A),
                new TestEnum(TestEnum::TEST_VALUE_B),
                new TestEnum(TestEnum::TEST_VALUE_C),
                new TestEnum(TestEnum::TEST_VALUE_D),
            ],
            TestEnum::getValues()
        );
    }

    /** @test */
    public function resolveCodeInvalidArgumentTest(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('TEST_VALUE is not a valid code for ' . TestEnum::class . '.');

        TestEnum::resolveCode('TEST_VALUE');
    }

    /** @test */
    public function resolveCodeTest(): void
    {
        static::assertEquals(
            TestEnum::TEST_VALUE_D,
            (TestEnum::resolveCode('TEST_VALUE_D'))->getValue()
        );
    }

    /** @test */
    public function resolveValueInvalidArgumentTest(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('10 is not a valid value for ' . TestEnum::class . '.');

        TestEnum::resolveValue(10);
    }

    /** @test */
    public function resolveValueScalarValueTest(): void
    {
        $enum = TestEnum::resolveValue(2);

        static::assertEquals('TEST_VALUE_C', $enum->getCode());
        static::assertEquals('TEST_VALUE_C', $enum->getDescription());
    }

    /** @test */
    public function resolveValueArrayValueTest(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Provided value is not valid : cannot use an array as constant value in ' . TestEnum::class . '.'
        );

        TestEnum::resolveValue(['value', 'description']);
    }

    /** @test */
    public function getScalarEnumTest(): void
    {
        $enum = new TestEnum(TestEnum::TEST_VALUE_A);

        static::assertEquals('TEST_VALUE_A', $enum->getCode());
        static::assertEquals('TEST_VALUE_A', $enum->getDescription());
        static::assertTrue($enum->getValue());
    }
}

<?php

/*
 * Copyright (c) 2016 - 2022 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Enum;

use Itspire\Common\Tests\Fixtures\Enum\TestExtendedBackedEnum;
use PHPUnit\Framework\TestCase;

class ExtendedBackedEnumTest extends TestCase
{
    /** @test */
    public function getValueTest(): void
    {
        static::assertEquals(1, TestExtendedBackedEnum::TEST_VALUE_A->value);
        static::assertEquals(1, TestExtendedBackedEnum::TEST_VALUE_A->getValue());
    }

    /** @test */
    public function getRawValuesTest(): void
    {
        static::assertEquals(
            [
                TestExtendedBackedEnum::TEST_VALUE_A,
                TestExtendedBackedEnum::TEST_VALUE_B,
                TestExtendedBackedEnum::TEST_VALUE_C,
                TestExtendedBackedEnum::TEST_VALUE_D,
            ],
            TestExtendedBackedEnum::cases()
        );
    }

    /** @test */
    public function getAllValuesTest(): void
    {
        static::assertEquals(
            ['TEST_VALUE_A' => 1, 'TEST_VALUE_B' => 2, 'TEST_VALUE_C' => 3, 'TEST_VALUE_D' => 4],
            TestExtendedBackedEnum::getAllValues()
        );
    }

    /** @test */
    public function resolveNameInvalidArgumentTest(): void
    {
        static::assertNull(TestExtendedBackedEnum::fromName('TEST_UNKNOWN'));
    }

    /** @test */
    public function resolveNameTest(): void
    {
        $enum = TestExtendedBackedEnum::fromName('TEST_VALUE_D');

        static::assertEquals('TEST_VALUE_D', $enum->getName());
        static::assertEquals('TEST_VALUE_D', $enum->name);
        static::assertEquals('My custom description for TEST_VALUE_D', $enum->getDescription());
        static::assertEquals(4, $enum->value);
    }
}

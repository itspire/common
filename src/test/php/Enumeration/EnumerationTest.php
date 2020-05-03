<?php

/**
 * Copyright (c) 2016 - 2019 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Enumeration;

use Itspire\Common\Tests\Fixtures\TestEnumeration;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Itspire\Common\Tests\Fixtures\TestEnumeration
 * @covers ::__construct
 */
class EnumerationTest extends TestCase
{
    private TestEnumeration $enumeration;

    protected function setUp(): void
    {
        parent::setUp();

        $this->enumeration = new TestEnumeration(TestEnumeration::TEST_VALUE_A);
    }

    protected function tearDown(): void
    {
        unset($this->enumeration);

        parent::tearDown();
    }

    /** @test */
    public function createEnumerationObjectWithInvalidArgumentTest(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Provided value is not valid : must be a valid constant value in ' . TestEnumeration::class . '.'
        );

        new TestEnumeration(10);
    }

    /** @test */
    public function createEnumerationObjectTest(): void
    {
        static::assertTrue((new TestEnumeration(TestEnumeration::TEST_VALUE_A))->getValue());
    }

    /**
     * @test
     *
     * @covers ::getRawValues
     */
    public function getRawValuesTest(): void
    {
        static::assertEquals(
            [
                'TEST_VALUE_A' => TestEnumeration::TEST_VALUE_A,
                'TEST_VALUE_B' => TestEnumeration::TEST_VALUE_B,
                'TEST_VALUE_C' => TestEnumeration::TEST_VALUE_C,
                'TEST_VALUE_D' => TestEnumeration::TEST_VALUE_D,
                'TEST_VALUE_E' => TestEnumeration::TEST_VALUE_E,
            ],
            TestEnumeration::getRawValues()
        );
    }

    /**
     * @test
     *
     * @covers ::getValues
     */
    public function getValuesTest(): void
    {
        static::assertEquals(
            [
                new TestEnumeration(TestEnumeration::TEST_VALUE_A),
                new TestEnumeration(TestEnumeration::TEST_VALUE_B),
                new TestEnumeration(TestEnumeration::TEST_VALUE_C),
                new TestEnumeration(TestEnumeration::TEST_VALUE_D),
                new TestEnumeration(TestEnumeration::TEST_VALUE_E),
            ],
            TestEnumeration::getValues()
        );
    }

    /**
     * @test
     *
     * @covers ::resolveCode
     */
    public function resolveCodeInvalidArgumentTest(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('TEST_VALUE is not a valid code for ' . TestEnumeration::class . '.');

        TestEnumeration::resolveCode('TEST_VALUE');
    }

    /**
     * @test
     *
     * @covers ::resolveCode
     */
    public function resolveCodeTest(): void
    {
        static::assertEquals(
            TestEnumeration::TEST_VALUE_D[0],
            (TestEnumeration::resolveCode('TEST_VALUE_D'))->getValue()
        );
    }

    /**
     * @test
     *
     * @covers ::resolveValue
     */
    public function resolveValueInvalidArgumentTest(): void
    {

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('10 is not a valid value for ' . TestEnumeration::class . '.');

        TestEnumeration::resolveValue(10);
    }

    /**
     * @test
     *
     * @covers ::resolveValue
     */
    public function resolveValueScalarValueTest(): void
    {
        $enumeration = TestEnumeration::resolveValue(2);

        static::assertEquals('TEST_VALUE_C', $enumeration->getCode());
        static::assertEmpty($enumeration->getDescription());
    }

    /**
     * @test
     *
     * @covers ::resolveValue
     */
    public function resolveValueArrayValueTest(): void
    {
        static::assertEquals(
            TestEnumeration::TEST_VALUE_D[1],
            (TestEnumeration::resolveValue('value'))->getDescription()
        );
    }

    /**
     * @test
     *
     * @covers ::getCode
     * @covers ::getValue
     * @covers ::getDescription
     */
    public function getScalarEnumerationTest(): void
    {
        $enumeration = new TestEnumeration(TestEnumeration::TEST_VALUE_A);

        static::assertEquals('TEST_VALUE_A', $enumeration->getCode());
        static::assertTrue($enumeration->getValue());
        static::assertEmpty($enumeration->getDescription());
    }

    /**
     * @test
     *
     * @covers ::getCode
     * @covers ::getValue
     * @covers ::getDescription
     */
    public function getArrayEnumerationTest(): void
    {
        $enumeration = new TestEnumeration(TestEnumeration::TEST_VALUE_D);

        static::assertEquals('TEST_VALUE_D', $enumeration->getCode());
        static::assertEquals('value', $enumeration->getValue());
        static::assertEquals('description', $enumeration->getDescription());
    }
}

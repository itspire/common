<?php

/*
 * Copyright (c) 2016 - 2022 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Enum;

use Itspire\Common\Enum\Http\HttpMethod;
use Itspire\Common\Enum\Http\HttpResponseStatus;
use PHPUnit\Framework\TestCase;

class ExtendedBackedEnumTest extends TestCase
{
    /** @test */
    public function getValueTest(): void
    {
        static::assertEquals('GET', HttpMethod::GET->value);
        static::assertEquals('GET', HttpMethod::GET->getValue());
    }

    /** @test */
    public function getRawValuesTest(): void
    {
        static::assertEquals(
            [
                HttpMethod::GET,
                HttpMethod::POST,
                HttpMethod::PUT,
                HttpMethod::PATCH,
                HttpMethod::DELETE,
                HttpMethod::HEAD,
                HttpMethod::OPTIONS,
                HttpMethod::CONNECT,
            ],
            HttpMethod::cases()
        );
    }

    /** @test */
    public function getAllValuesTest(): void
    {
        $values = HttpResponseStatus::getAllValues();
        static::assertCount(62, $values);

        static::assertEquals(HttpResponseStatus::HTTP_CONTINUE->value, array_shift($values));
    }

    /** @test */
    public function resolveNameInvalidArgumentTest(): void
    {
        static::assertNull(HttpMethod::fromName('UNKNOWN'));
    }

    /** @test */
    public function resolveNameTest(): void
    {
        $enum = HttpResponseStatus::fromName('HTTP_CONTINUE');

        static::assertEquals('HTTP_CONTINUE', $enum->getName());
        static::assertEquals('HTTP_CONTINUE', $enum->name);
        static::assertEquals('Continue', $enum->getDescription());
        static::assertEquals(100, $enum->value);
    }
}

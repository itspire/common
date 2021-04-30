<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Fixtures\Util;

use Itspire\Common\Util\EquatableInterface;
use PHPUnit\Framework\TestCase;

class EquatableTraitTest extends TestCase
{
    private ?EquatableInterface $testEquatable = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->testEquatable = (new TestEquatable())->setField(1);
    }

    protected function tearDown(): void
    {
        unset($this->testEquatable);

        parent::tearDown();
    }

    /** @test */
    public function notEqualsTest(): void
    {
        static::assertFalse(
            $this->testEquatable->equals((new TestEquatable())->setField(2))
        );
    }

    /** @test */
    public function equalsTest(): void
    {
        static::assertTrue(
            $this->testEquatable->equals((new TestEquatable())->setField(1))
        );
    }
}

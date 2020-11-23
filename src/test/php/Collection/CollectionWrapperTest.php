<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Collection;

use Itspire\Common\Collection\CollectionWrapper;
use Itspire\Common\Collection\CollectionWrapperInterface;
use Itspire\Common\Tests\Fixtures\Enum\TestEnum;
use Itspire\Common\Tests\Fixtures\Utils\TestEquatable;
use PHPUnit\Framework\TestCase;

class CollectionWrapperTest extends TestCase
{
    private ?CollectionWrapperInterface $collectionHolder = null;

    protected function setUp(): void
    {
        parent::setUp();

        $testEquatable = (new TestEquatable())->setField(1);

        $this->collectionHolder = (new CollectionWrapper(TestEquatable::class))->addElement($testEquatable);
    }

    protected function tearDown(): void
    {
        unset($this->collectionHolder);

        parent::tearDown();
    }

    /** @test */
    public function createWithNonFullyQualifiedNameTest(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid fully qualified class name : TestEquatable');

        new CollectionWrapper('TestEquatable');
    }

    /** @test */
    public function createWithUnsupportedElementTest(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'At least one element you tried to add to the collection is not an instance of ' . TestEquatable::class
        );

        new CollectionWrapper(TestEquatable::class, [new TestEnum(TestEnum::TEST_VALUE_A)]);
    }

    /** @test */
    public function addUnsupportedElementTest(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'At least one element you tried to add to the collection is not an instance of ' . TestEquatable::class
        );

        $this->collectionHolder->addElement(new TestEnum(TestEnum::TEST_VALUE_A));
    }


    /** @test */
    public function addExistingElementTest(): void
    {
        $testEquatable = (new TestEquatable())->setField(1);

        $this->collectionHolder->addElement($testEquatable);

        static::assertCount(1, $this->collectionHolder->getElements());
    }

    /** @test */
    public function addNewElementTest(): void
    {
        $testEquatable = (new TestEquatable())->setField(2);

        $this->collectionHolder->addElement($testEquatable);

        static::assertCount(2, $this->collectionHolder->getElements());
    }

    /** @test */
    public function removeNonExistingElementTest(): void
    {
        $testEquatable = (new TestEquatable())->setField(2);

        $this->collectionHolder->removeElement($testEquatable);

        static::assertCount(1, $this->collectionHolder->getElements());
    }

    /** @test */
    public function removeExistingFromCollectionTest(): void
    {
        $testEquatable = (new TestEquatable())->setField(1);

        $this->collectionHolder->removeElement($testEquatable);

        static::assertCount(0, $this->collectionHolder->getElements());
    }
}

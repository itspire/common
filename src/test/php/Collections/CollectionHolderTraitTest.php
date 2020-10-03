<?php

/**
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Collections;

use Itspire\Common\Tests\Fixtures\Collections\TestCollectionHolder;
use Itspire\Common\Tests\Fixtures\Utils\TestEquatable;
use PHPUnit\Framework\TestCase;

class CollectionHolderTraitTest extends TestCase
{
    private TestCollectionHolder $collectionHolder;

    protected function setUp(): void
    {
        parent::setUp();

        $testEquatable = (new TestEquatable())->setField(1);

        $this->collectionHolder = (new TestCollectionHolder())->addToCollection($testEquatable);
    }

    protected function tearDown(): void
    {
        unset($this->collectionHolder);

        parent::tearDown();
    }

    /** @test */
    public function addExistingToCollectionTest(): void
    {
        $testEquatable = (new TestEquatable())->setField(1);

        $this->collectionHolder->addToCollection($testEquatable);

        static::assertCount(1, $this->collectionHolder->getCollection());
    }

    /** @test */
    public function addNewToCollectionTest(): void
    {
        $testEquatable = (new TestEquatable())->setField(2);

        $this->collectionHolder->addToCollection($testEquatable);

        static::assertCount(2, $this->collectionHolder->getCollection());
    }

    /** @test */
    public function removeNonExistingFromCollectionTest(): void
    {
        $testEquatable = (new TestEquatable())->setField(2);

        $this->collectionHolder->removeFromCollection($testEquatable);

        static::assertCount(1, $this->collectionHolder->getCollection());
    }

    /** @test */
    public function removeExistingFromCollectionTest(): void
    {
        $testEquatable = (new TestEquatable())->setField(1);

        $this->collectionHolder->removeFromCollection($testEquatable);

        static::assertCount(0, $this->collectionHolder->getCollection());
    }
}

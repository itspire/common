<?php

/**
 * Copyright (c) 2016 - 2019 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Fixtures\Collections;

use Doctrine\Common\Collections as DoctrineCollections;
use Itspire\Common\Collections\CollectionHolderInterface;
use Itspire\Common\Collections\CollectionHolderTrait;
use Itspire\Common\Utils\EquatableInterface;

class TestCollectionHolder implements CollectionHolderInterface
{
    use CollectionHolderTrait;

    private DoctrineCollections\Collection $collection;

    public function __construct()
    {
        $this->collection = new DoctrineCollections\ArrayCollection();
    }

    public function getCollection(): DoctrineCollections\Collection
    {
        return $this->collection;
    }

    public function addToCollection(EquatableInterface $element): TestCollectionHolder
    {
        if (0 === $this->collection->count() || false === $this->checkEquatableExists($this->collection, $element)) {
            $this->collection->add($element);
        }

        return $this;
    }

    public function removeFromCollection(EquatableInterface $element): TestCollectionHolder
    {

        $filteredList = $this->filterEquatableExists($this->collection, $element);

        if (1 === $filteredList->count()) {
            $this->collection->removeElement($filteredList->first());
        }

        return $this;
    }
}

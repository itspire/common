<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Collection;

use Doctrine\Common\Collections as DoctrineCollections;
use Itspire\Common\Util\EquatableInterface;

interface CollectionWrapperInterface extends CollectionHolderInterface
{
    public function addElement(EquatableInterface $element): self;

    public function removeElement(EquatableInterface $element): self;

    public function getElements(): DoctrineCollections\Collection;
}

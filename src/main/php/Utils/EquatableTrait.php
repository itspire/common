<?php

/**
 * Copyright (c) 2016 - 2019 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Utils;

trait EquatableTrait
{
    abstract public function getUniqueIdentifier();

    public function equals(EquatableInterface $object): bool
    {
        return $this->getUniqueIdentifier() === $object->getUniqueIdentifier();
    }
}

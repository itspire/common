<?php

/**
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Collections;

use Doctrine\Common\Collections\Collection;
use Itspire\Common\Utils\EquatableInterface;

interface CollectionHolderInterface
{
    public function checkEquatableExists(Collection $list, EquatableInterface $element): bool;

    public function filterEquatableExists(Collection $list, EquatableInterface $element): Collection;
}

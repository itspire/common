<?php

/**
 * Copyright (c) 2016 - 2019 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Collections;

use Doctrine\Common\Collections\Collection;
use Itspire\Common\Utils\EquatableInterface;

trait CollectionHolderTrait
{
    public function checkEquatableExists(Collection $list, EquatableInterface $element): bool
    {
        return $list->exists(
            function ($key, EquatableInterface $listElement) use ($element): bool {
                return $listElement->equals($element);
            }
        );
    }

    public function filterEquatableExists(Collection $list, EquatableInterface $element): Collection
    {
        return $list->filter(
            function (EquatableInterface $listElement) use ($element): bool {
                return $listElement->equals($element);
            }
        );
    }
}

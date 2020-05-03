<?php

/**
 * Copyright (c) 2016 - 2019 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Fixtures\Utils;

use Itspire\Common\Utils\EquatableInterface;
use Itspire\Common\Utils\EquatableTrait;

class TestEquatable implements EquatableInterface
{
    use EquatableTrait;

    private int $field;

    public function getField(): int
    {
        return $this->field;
    }

    public function setField(int $field): TestEquatable
    {
        $this->field = $field;

        return $this;
    }

    public function getUniqueIdentifier(): int
    {
        return $this->field;
    }
}

<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Fixtures\Enum;

use Itspire\Common\Enum\AbstractEnum;

class TestEnum2 extends AbstractEnum
{
    public const TEST_VALUE_A = true;
    public const TEST_VALUE_B = null;
    public const TEST_VALUE_C = 2;
    public const TEST_VALUE_D = 'value';

    protected static array $descriptions = [
        self::TEST_VALUE_D => 'My custom description for TEST_VALUE_D'
    ];
}

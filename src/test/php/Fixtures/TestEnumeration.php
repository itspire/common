<?php

/**
 * Copyright (c) 2016 - 2019 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Fixtures;

use Itspire\Common\Enumeration\AbstractEnumeration;

class TestEnumeration extends AbstractEnumeration
{
    /** @var bool TEST_VALUE_A */
    public const TEST_VALUE_A = true;

    /** @var null TEST_VALUE_A */
    public const TEST_VALUE_B = null;

    /** @var int TEST_VALUE_A */
    public const TEST_VALUE_C = 2;

    /** @var array TEST_VALUE_A */
    public const TEST_VALUE_D = ['value', 'description'];

    /** @var array TEST_VALUE_E */
    public const TEST_VALUE_E = [[], 'description'];
}

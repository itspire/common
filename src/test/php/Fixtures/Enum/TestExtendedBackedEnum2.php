<?php

/*
 * Copyright (c) 2016 - 2022 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Fixtures\Enum;

use Itspire\Common\Enum\ExtendedBackedEnumTrait;

enum TestExtendedBackedEnum2: int
{
    use ExtendedBackedEnumTrait;

    case TEST_VALUE_A = 1;
    case TEST_VALUE_B = 2;
    case TEST_VALUE_C = 3;
    case TEST_VALUE_D = 4;

    /**
     * @phpcs:disable Generic.WhiteSpace.ScopeIndent.Incorrect
     * @phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
     */
    public static function getAllDescriptions(): array
    {
        return array_merge(
            array_map(fn (\BackedEnum $item): string => $item->name, self::cases()),
            [self::TEST_VALUE_D->name => 'My custom description for TEST_VALUE_D']
        );
    }
}

<?php

/*
 * Copyright (c) 2016 - 2022 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Enum;

interface ExtendedBackedEnumInterface extends \BackedEnum
{
    public static function getAllValues(): array;

    /** Returns the array of descriptions with the respective case name as key */
    public static function getAllDescriptions(): array;

    public static function fromName(string $name): ?self;

    /** @deprecated Use getName instead */
    public function getCode(): string;

    public function getName(): string;

    public function getValue();

    public function getDescription(): ?string;
}

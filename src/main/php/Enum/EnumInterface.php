<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Enum;

use Itspire\Common\Util\EquatableInterface;

interface EnumInterface extends EquatableInterface
{
    public static function getRawValues(): array;

    public static function getValues(): array;

    public static function resolveCode(string $code): self;

    public static function resolveValue($value): self;

    public function getCode(): string;

    public function getValue();

    public function getDescription(): ?string;
}

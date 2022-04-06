<?php

/*
 * Copyright (c) 2016 - 2022 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Enum;

/** @deprecated Will be removed in 3.0, use ExtendedBackedEnumInterface::class instead */
interface EnumInterface
{
    /** @deprecated Use ExtendedEnumInterface::getAllValues instead */
    public static function getRawValues(): array;

    /** @deprecated Use ExtendedEnumInterface::cases instead */
    public static function getValues(): array;

    /** @deprecated Use ClassFQDN::$code instead */
    public static function resolveCode(string $code): self;

    /** @deprecated Use ExtendedEnumInterface::from instead */
    public static function resolveValue($value): self;

    public function getCode(): string;

    public function getValue();

    public function getDescription(): ?string;
}

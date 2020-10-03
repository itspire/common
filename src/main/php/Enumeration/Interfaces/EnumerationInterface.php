<?php

/**
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Enumeration\Interfaces;

interface EnumerationInterface
{
    public static function getRawValues(): array;

    public static function getValues(): array;

    public static function resolveCode(string $code): EnumerationInterface;

    public static function resolveValue($value): EnumerationInterface;

    public function getCode(): string;

    public function getValue();

    public function getDescription(): ?string;
}
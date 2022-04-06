<?php

/*
 * Copyright (c) 2016 - 2022 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Enum;

trait ExtendedBackedEnumTrait
{
    public static function getAllValues(): array
    {
        return array_reduce(
            self::cases(),
            fn(array $carry, \BackedEnum $item): array => array_merge($carry, [$item->name => $item->value]),
            []
        );
    }

    public static function fromName(string $name): ?self
    {
        $enumMap = array_combine(
            array_map(fn(\BackedEnum $item): string => $item->name, self::cases()),
            self::cases()
        );

        return $enumMap[$name] ?? null;
    }

    /** @deprecated Use getName instead */
    public function getCode(): string
    {
        return $this->name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string | int
    {
        return $this->value;
    }

    public function getDescription(): ?string
    {
        return self::getAllDescriptions()[$this->name];
    }

    public static function getAllDescriptions(): array
    {
        return array_combine(
            array_map(fn(\BackedEnum $item): string => $item->name, self::cases()),
            array_map(fn(\BackedEnum $item): string => $item->name, self::cases())
        );
    }
}

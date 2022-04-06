<?php

/*
 * Copyright (c) 2016 - 2022 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Enum;

/** @deprecated Will be removed in 3.0, use native php enums with ExtendedBackedEnumTrait::class instead */
abstract class AbstractEnum implements EnumInterface
{
    protected static array $descriptions = [];

    protected string $code;
    protected $value;
    protected string $description;

    public function __construct($constValue)
    {
        $rawValues = static::getRawValues();

        if (!in_array($constValue, $rawValues, true)) {
            throw new \InvalidArgumentException(
                'Provided value is not valid : must be a valid constant value in ' . static::class . '.'
            );
        }

        if (is_array($constValue)) {
            throw new \InvalidArgumentException(
                'Provided value is not valid : cannot use an array as constant value in ' . static::class . '.'
            );
        }

        foreach ($rawValues as $code => $rawConstValue) {
            if ($rawConstValue === $constValue) {
                $this->code = $code;
                $this->value = $constValue;
                $this->description = static::$descriptions[$this->value] ?? $this->code;
            }
        }
    }

    /** @deprecated Use ExtendedEnumInterface::getAllValues instead */
    public static function getRawValues(): array
    {
        return (new \ReflectionClass(static::class))->getConstants();
    }

    /** @deprecated Use ExtendedEnumInterface::cases instead */
    public static function getValues(): array
    {
        $values = [];
        foreach (static::getRawValues() as $constValue) {
            $values[] = new static($constValue);
        }

        return $values;
    }

    /** @deprecated Use ClassFQDN::$code instead */
    public static function resolveCode(string $code): self
    {
        foreach (static::getRawValues() as $constCode => $constValue) {
            if ($constCode === $code) {
                return new static($constValue);
            }
        }
        throw new \InvalidArgumentException(sprintf('%s is not a valid code for %s.', $code, static::class));
    }

    /** @deprecated Use ExtendedEnumInterface::from instead */
    public static function resolveValue($value): self
    {
        if (is_array($value)) {
            throw new \InvalidArgumentException(
                'Provided value is not valid : cannot use an array as constant value in ' . static::class . '.'
            );
        }

        foreach (static::getRawValues() as $constValue) {
            if ($constValue === $value) {
                return new static($constValue);
            }
        }
        throw new \InvalidArgumentException($value . ' is not a valid value for ' . static::class . '.');
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}

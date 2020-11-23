<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Enum;

use Itspire\Common\Util\EquatableTrait;

abstract class AbstractEnum implements EnumInterface
{
    use EquatableTrait;

    private string $code;
    private $value;
    private string $description;

    public function __construct($constValue)
    {
        $rawValues = static::getRawValues();

        if (!in_array($constValue, $rawValues, true)) {
            throw new \InvalidArgumentException(
                'Provided value is not valid : must be a valid constant value in ' . static::class . '.'
            );
        }

        $this->code = array_search($constValue, $rawValues, true);
        $this->value = (is_array($constValue)) ? $constValue[0] : $constValue;
        $this->description = (is_array($constValue) && isset($constValue[1])) ? $constValue[1] : $this->code;
    }

    public static function getRawValues(): array
    {
        return (new \ReflectionClass(static::class))->getConstants();
    }

    public static function getValues(): array
    {
        $values = [];
        foreach (static::getRawValues() as $constValue) {
            $values[] = new static($constValue);
        }

        return $values;
    }

    public static function resolveCode(string $code): self
    {
        foreach (static::getRawValues() as $constCode => $constValue) {
            if ($constCode === $code) {
                return new static($constValue);
            }
        }
        throw new \InvalidArgumentException($code . ' is not a valid code for ' . static::class . '.');
    }

    public static function resolveValue($value): self
    {
        foreach (static::getRawValues() as $constValue) {
            if (((is_array($constValue)) ? $constValue[0] : $constValue) === $value) {
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

    public function getUniqueIdentifier(): ?string
    {
        return $this->code;
    }
}

<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Enum\Validator\Constraint;

use Itspire\Common\Enum\AbstractEnum;
use Itspire\Common\Enum\Validator\EnumValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\InvalidOptionsException;
use Symfony\Component\Validator\Exception\MissingOptionsException;
use Symfony\Component\Validator\Exception\ValidatorException;

/** @Annotation */
class Enum extends Constraint
{
    /** @var string NULL_VALUE */
    public const NULL_VALUE = 'enum.null.value';

    /** @var string INVALID_VALUE */
    public const INVALID_VALUE = 'enum.invalid.value';

    public string $enumClass = '';

    /**
     * Initializes the constraint with options.
     *
     * You should pass an associative array. The keys should be the names of
     * existing properties in this class. The values should be the value for these
     * properties.
     *
     * Alternatively you can override the method getDefaultOption() to return the
     * name of an existing property. If no associative array is passed, this
     * property is set instead.
     *
     * You can force that certain options are set by overriding
     * getRequiredOptions() to return the names of these options. If any
     * option is not set here, an exception is thrown.
     *
     * @param mixed $options The options (as associative array) or the value for the default option (any other type)
     *
     * @throws InvalidOptionsException When you pass the names of non-existing options
     * @throws MissingOptionsException When you don't pass any of the options returned by getRequiredOptions()
     * @throws ConstraintDefinitionException If you don't pass an associative array and getDefaultOption() returns null
     * @throws ValidatorException When the enumClass property contains an invalid class name or the name of a
     *     class that does not extend \Itspire\Common\Enum\AbstractEnum
     */
    public function __construct($options = null)
    {
        parent::__construct($options);

        try {
            $enumReflection = new \ReflectionClass($this->enumClass);

            if (!$enumReflection->isSubclassOf(AbstractEnum::class)) {
                throw new ValidatorException(
                    sprintf(
                        'The option enumClass must be the name of a class that extends %s.',
                        AbstractEnum::class
                    )
                );
            }
        } catch (\ReflectionException $e) {
            throw new ValidatorException(
                sprintf('The option enumClass must be a valid class FQN : %s provided', $this->enumClass),
                0,
                $e
            );
        }
    }

    public function validatedBy(): string
    {
        return EnumValidator::class;
    }

    public function getRequiredOptions(): array
    {
        return ['enumClass'];
    }

    public function getDefaultOption(): string
    {
        return 'enumClass';
    }
}

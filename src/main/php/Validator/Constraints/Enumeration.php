<?php

/**
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Validator\Constraints;

use Itspire\Common\Enumeration\AbstractEnumeration;
use Itspire\Common\Validator\EnumerationValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\InvalidOptionsException;
use Symfony\Component\Validator\Exception\MissingOptionsException;
use Symfony\Component\Validator\Exception\ValidatorException;

/** @Annotation */
class Enumeration extends Constraint
{
    /** @var string NULL_VALUE */
    public const NULL_VALUE = 'enumeration.null.value';

    /** @var string INVALID_VALUE */
    public const INVALID_VALUE = 'enumeration.invalid.value';

    public string $enumerationClass = '';

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
     * @throws ValidatorException When the enumerationClass property contains an invalid class name or the name of a
     *     class that does not extend \Itspire\Common\Enumeration\AbstractEnumeration
     */
    public function __construct($options = null)
    {
        parent::__construct($options);

        try {
            $enumerationReflection = new \ReflectionClass($this->enumerationClass);

            if (!$enumerationReflection->isSubclassOf(AbstractEnumeration::class)) {
                throw new ValidatorException(
                    sprintf(
                        'The option enumerationClass must be the name of a class that extends %s.',
                        AbstractEnumeration::class
                    )
                );
            }
        } catch (\ReflectionException $e) {
            throw new ValidatorException('The option enumerationClass must be a valid class FQN.', 0, $e);
        }
    }

    public function validatedBy(): string
    {
        return EnumerationValidator::class;
    }

    public function getRequiredOptions(): array
    {
        return ['enumerationClass'];
    }

    public function getDefaultOption(): string
    {
        return 'enumerationClass';
    }
}

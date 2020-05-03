<?php

/**
 * Copyright (c) 2016 - 2019 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Validator;

use Itspire\Common\Tests\Fixtures\TestEnumeration;
use Itspire\Common\Validator\Constraints\Enumeration;
use Itspire\Common\Validator\EnumerationValidator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Validator\ContextualValidatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class EnumerationValidatorTest extends TestCase
{
    private EnumerationValidator $enumerationValidator;
    private ExecutionContext $context;

    protected function setUp(): void
    {
        parent::setUp();

        $translator = $this->getMockBuilder(TranslatorInterface::class)->getMock();
        $validator = $this->getMockBuilder(ValidatorInterface::class)->getMock();
        $contextualValidator = $this->getMockBuilder(ContextualValidatorInterface::class)->getMock();

        $this->context = new ExecutionContext($validator, 'root', $translator);
        $this->context->setConstraint(new Enumeration(['enumerationClass' => TestEnumeration::class]));

        $translator->method('trans')->willReturnArgument(0);
        $validator->method('inContext')->with($this->context)->willReturn($contextualValidator);

        $this->enumerationValidator = new EnumerationValidator();
        $this->enumerationValidator->initialize($this->context);
    }

    protected function tearDown(): void
    {
        unset($this->enumerationValidator, $this->context);

        parent::tearDown();
    }

    /** @test */
    public function validateUnexpectedTypeTest(): void
    {
        $this->expectException(UnexpectedTypeException::class);

        $this->enumerationValidator->validate('test', new Choice());
    }

    /** @test */
    public function validateNullValueTest(): void
    {
        $this->enumerationValidator->validate(
            null,
            new Enumeration(['enumerationClass' => TestEnumeration::class])
        );

        $violations = $this->context->getViolations();

        static::assertNotEquals(0, $violations->count());
        static::assertEquals('enumeration.null.value', $violations->get(0)->getMessageTemplate());
    }

    /** @test */
    public function validateInvalidValueTest(): void
    {
        $this->enumerationValidator->validate(
            'test',
            new Enumeration(['enumerationClass' => TestEnumeration::class])
        );

        $violations = $this->context->getViolations();

        static::assertNotEquals(0, $violations->count());
        static::assertEquals('enumeration.invalid.value', $violations->get(0)->getMessageTemplate());
    }

    /** @test */
    public function validateTest(): void
    {
        $this->enumerationValidator->validate(
            new TestEnumeration(TestEnumeration::TEST_VALUE_D),
            new Enumeration(['enumerationClass' => TestEnumeration::class])
        );

        $violations = $this->context->getViolations();

        static::assertEquals(0, $violations->count());
    }
}

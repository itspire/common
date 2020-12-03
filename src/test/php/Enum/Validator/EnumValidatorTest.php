<?php

/*
 * Copyright (c) 2016 - 2020 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Validator;

use Itspire\Common\Tests\Fixtures\Enum\TestEnum;
use Itspire\Common\Tests\Fixtures\Enum\TestEnum2;
use Itspire\Common\Enum\Validator\Constraint\Enum;
use Itspire\Common\Enum\Validator\EnumValidator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Validator\ContextualValidatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class EnumValidatorTest extends TestCase
{
    private EnumValidator $enumValidator;
    private ExecutionContext $context;

    protected function setUp(): void
    {
        parent::setUp();

        $translator = $this->getMockBuilder(TranslatorInterface::class)->getMock();
        $validator = $this->getMockBuilder(ValidatorInterface::class)->getMock();
        $contextualValidator = $this->getMockBuilder(ContextualValidatorInterface::class)->getMock();

        $this->context = new ExecutionContext($validator, 'root', $translator);
        $this->context->setConstraint(new Enum(['enumClass' => TestEnum::class]));

        $translator->method('trans')->willReturnArgument(0);
        $validator->method('inContext')->with($this->context)->willReturn($contextualValidator);

        $this->enumValidator = new EnumValidator();
        $this->enumValidator->initialize($this->context);
    }

    protected function tearDown(): void
    {
        unset($this->enumValidator, $this->context);

        parent::tearDown();
    }

    /** @test */
    public function validateUnexpectedTypeTest(): void
    {
        $this->expectException(UnexpectedTypeException::class);

        $this->enumValidator->validate('test', new Choice());
    }

    /** @test */
    public function validateInvalidValueTest(): void
    {
        $this->expectException(UnexpectedTypeException::class);

        $this->enumValidator->validate(
            'test',
            new Enum(['enumClass' => TestEnum::class])
        );
    }

    /** @test */
    public function validateNullValueTest(): void
    {
        $this->enumValidator->validate(
            null,
            new Enum(['enumClass' => TestEnum::class])
        );

        $violations = $this->context->getViolations();

        static::assertNotEquals(0, $violations->count());
        static::assertEquals('enum.null.value', $violations->get(0)->getMessageTemplate());
    }

    /** @test */
    public function validateInvalidEnumValueTest(): void
    {
        $this->enumValidator->validate(
            new TestEnum2(TestEnum2::TEST_VALUE_D),
            new Enum(['enumClass' => TestEnum::class])
        );

        $violations = $this->context->getViolations();

        static::assertNotEquals(0, $violations->count());
        static::assertEquals('enum.invalid.value', $violations->get(0)->getMessageTemplate());
    }

    /** @test */
    public function validateTest(): void
    {
        $this->enumValidator->validate(
            new TestEnum(TestEnum::TEST_VALUE_D),
            new Enum(['enumClass' => TestEnum::class])
        );

        $violations = $this->context->getViolations();

        static::assertEquals(0, $violations->count());
    }
}

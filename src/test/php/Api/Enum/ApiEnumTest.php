<?php

/*
 * Copyright (c) 2016 - 2022 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Api\Enum;

use Itspire\Common\Tests\Fixtures\Api\Enum\TestApiEnum;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;

class ApiEnumTest extends TestCase
{
    private static ?SerializerInterface $serializer = null;
    private ?TestApiEnum $testEnum = null;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        if (null === self::$serializer) {
            $serializerBuilder = SerializerBuilder::create();
            self::$serializer = $serializerBuilder->build();
        }
    }

    public static function tearDownAfterClass(): void
    {
        static::$serializer = null;
        parent::tearDownAfterClass();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testEnum = new TestApiEnum();
        $this->testEnum->setCode('TEST')->setDescription('test');
    }

    protected function tearDown(): void
    {
        unset($this->testEnum);

        parent::tearDown();
    }

    /** @test */
    public function serializeTestEnumTest(): void
    {
        static::assertXmlStringEqualsXmlFile(
            realpath('src/test/resources/test_api_enum.xml'),
            static::$serializer->serialize($this->testEnum, 'xml')
        );
    }

    /** @test */
    public function deserializeTestEnumTest(): void
    {
        /** @var \SimpleXMLElement $testEnumXml */
        $testEnumXml = simplexml_load_string(
            file_get_contents(realpath('src/test/resources/test_api_enum.xml'))
        );

        /** @var TestApiEnum $deserializedResult */
        $deserializedResult = static::$serializer->deserialize($testEnumXml->asXML(), TestApiEnum::class, 'xml');

        static::assertEquals('TEST', $deserializedResult->getCode());
        static::assertEquals('test', $deserializedResult->getDescription());
    }
}
<?php

/*
 * Copyright (c) 2016 - 2022 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Api\Enum;

use Itspire\Common\Api\Enum\ApiEnumWrapper;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;

class ExtendedApiEnumTest extends TestCase
{
    private static ?SerializerInterface $serializer = null;
    private ?ApiEnumWrapper $apiEnumWrapper = null;

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

        $this->apiEnumWrapper = new ApiEnumWrapper();
        $this->apiEnumWrapper
            ->setName('TEST_VALUE_A')
            ->setDescription('My custom description for TEST_VALUE_A');
    }

    protected function tearDown(): void
    {
        unset($this->apiEnumWrapper);

        parent::tearDown();
    }

    /** @test */
    public function serializeTestEnumTest(): void
    {
        static::assertXmlStringEqualsXmlFile(
            realpath('src/test/resources/api_enum_wrapper.xml'),
            static::$serializer->serialize($this->apiEnumWrapper, 'xml')
        );
    }

    /** @test */
    public function deserializeTestEnumTest(): void
    {
        /** @var \SimpleXMLElement $testBaseEnumXml */
        $testBaseEnumXml = simplexml_load_string(
            file_get_contents(realpath('src/test/resources/api_enum_wrapper.xml'))
        );

        /** @var ApiEnumWrapper $deserializedResult */
        $deserializedResult = static::$serializer->deserialize($testBaseEnumXml->asXML(), ApiEnumWrapper::class, 'xml');

        static::assertEquals('TEST_VALUE_A', $deserializedResult->getName());
        static::assertEquals('My custom description for TEST_VALUE_A', $deserializedResult->getDescription());
    }
}

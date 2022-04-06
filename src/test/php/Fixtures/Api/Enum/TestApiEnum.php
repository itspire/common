<?php

/*
 * Copyright (c) 2016 - 2022 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Fixtures\Api\Enum;

use Itspire\Common\Api\Enum\AbstractSerializableEnum;
use JMS\Serializer\Annotation as Serializer;

/** @Serializer\XmlRoot("test_enum") */
class TestApiEnum extends AbstractSerializableEnum
{
}

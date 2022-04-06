<?php

/*
 * Copyright (c) 2016 - 2022 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Api\Enum;

use JMS\Serializer\Annotation as Serializer;

/** @deprecated Will be removed in 3.0, use ApiEnumWrapper::class instead */
abstract class AbstractSerializableEnum implements SerializableEnumInterface
{
    /**
     * @Serializer\XmlAttribute
     * @Serializer\SerializedName("code")
     * @Serializer\Type("string")
     */
    private string $code = '';

    /**
     * @Serializer\XmlAttribute
     * @Serializer\SerializedName("description")
     * @Serializer\Type("string")
     */
    private ?string $description = null;

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): SerializableEnumInterface
    {
        $this->code = $code;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): SerializableEnumInterface
    {
        $this->description = $description;

        return $this;
    }
}

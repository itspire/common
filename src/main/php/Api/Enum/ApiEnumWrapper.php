<?php

/*
 * Copyright (c) 2016 - 2022 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Api\Enum;

use JMS\Serializer\Annotation as Serializer;

#[Serializer\XmlRoot('enum')]
final class ApiEnumWrapper
{
    #[Serializer\Type('string')]
    #[Serializer\XmlAttribute]
    private string $name;

    #[Serializer\Type('string')]
    #[Serializer\XmlAttribute]
    private string $description;

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}

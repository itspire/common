<?php

/*
 * Copyright (c) 2016 - 2022 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Api\Enum;

/** @deprecated Will be removed in 3.0 */
interface SerializableEnumInterface
{
    public function getCode(): string;

    public function setCode(string $code): SerializableEnumInterface;

    public function getDescription(): ?string;

    public function setDescription(string $description): SerializableEnumInterface;
}

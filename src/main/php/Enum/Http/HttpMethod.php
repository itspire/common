<?php

/*
 * Copyright (c) 2016 - 2022 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Enum\Http;

use Itspire\Common\Enum\ExtendedBackedEnumInterface;
use Itspire\Common\Enum\ExtendedBackedEnumTrait;

enum HttpMethod: string implements ExtendedBackedEnumInterface
{
    use ExtendedBackedEnumTrait;

    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case PATCH = 'PATCH';
    case DELETE = 'DELETE';
    case HEAD = 'HEAD';
    case OPTIONS = 'OPTIONS';
    case CONNECT = 'CONNECT';
}

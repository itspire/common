<?php

/*
 * Copyright (c) 2016 - 2022 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Util\Http\Security;

use Psr\Http\Message\RequestInterface;

class HmacUtils implements HmacUtilsInterface
{
    public function __construct(private string $algorithm)
    {
    }

    public function signRequest(RequestInterface $request, string $secret): string
    {
        $hmacRaw = sprintf('METHOD:%s|URI:%s', $request->getMethod(), $request->getUri());

        if (null !== $request->hasHeader('Content-Type')) {
            $hmacRaw .= sprintf('|CONTENT_TYPE:%s', implode(',', $request->getHeader('Content-Type')));
        }

        if (null !== $request->getBody()) {
            $hmacRaw .= sprintf('|BODY:{{%s}}', $request->getBody()->__toString());
        }

        return hash_hmac($this->algorithm, $hmacRaw, $secret);
    }

    public function validate(RequestInterface $request, string $secret, string $hash): bool
    {
        return $hash === $this->signRequest($request, $secret);
    }
}

<?php

/*
 * Copyright (c) 2016 - 2022 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

namespace Itspire\Common\Tests\Util\Http\Security;

use Itspire\Common\Enum\MimeType;
use Itspire\Common\Enum\Http\HttpMethod;
use Itspire\Common\Util\Http\Security\HmacUtils;
use Itspire\Common\Util\Http\Security\HmacUtilsInterface;
use Nyholm\Psr7\Request;
use Nyholm\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;

class HmacUtilsTest extends TestCase
{
    private ?HmacUtilsInterface $hmacUtils = null;
    private ?RequestInterface $request = null;
    private ?ServerRequestInterface $serverRequest = null;
    private string $hash = '90679264231af8707b4ac3d16662183c35c6eb3d1f3a98b0682592bd5a11947ecc21b548c40abe'
        . '7404ab143530791a826ae57972ac6187e321db49f229fd9399';

    protected function setUp(): void
    {
        parent::setUp();

        $uri = 'http://www.test.fr/users/1';
        $method = HttpMethod::GET;
        $body = 'php://temp';
        $headers = ['Content-Type' => MimeType::APPLICATION_XML->value];

        $this->hmacUtils = new HmacUtils('sha512');
        $this->request = new Request($method->value, $uri, $headers, $body);
        $this->serverRequest = new ServerRequest($method->value, $uri, $headers, $body);
    }

    protected function tearDown(): void
    {
        unset($this->hmacUtils, $this->request, $this->serverRequest);

        parent::tearDown();
    }

    /** @test */
    public function signRequestTest(): void
    {
        static::assertEquals($this->hash, $this->hmacUtils->signRequest($this->request, 'test'));
    }

    /** @test */
    public function validateTest(): void
    {
        static::assertTrue($this->validateHashTest($this->hash));
    }

    /** @test */
    public function validateFailTest(): void
    {
        static::assertFalse($this->validateHashTest(sprintf('%sfail', $this->hash)));
    }

    private function validateHashTest(string $hash): bool
    {
        return $this->hmacUtils->validate($this->serverRequest, 'test', $hash);
    }
}

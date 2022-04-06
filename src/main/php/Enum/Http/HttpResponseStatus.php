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

enum HttpResponseStatus: int implements ExtendedBackedEnumInterface
{
    use ExtendedBackedEnumTrait;

    // 1XX Informational
    case HTTP_CONTINUE = 100;
    case HTTP_SWITCHING_PROTOCOLS = 101;
    case HTTP_PROCESSING = 102; // RFC2518

    // 2XX Success
    case HTTP_OK = 200;
    case HTTP_CREATED = 201;
    case HTTP_ACCEPTED = 202;
    case HTTP_NON_AUTHORITATIVE_INFORMATION = 203;
    case HTTP_NO_CONTENT = 204;
    case HTTP_RESET_CONTENT = 205;
    case HTTP_PARTIAL_CONTENT = 206;
    case HTTP_MULTI_STATUS = 207; // RFC4918
    case HTTP_ALREADY_REPORTED = 208; // RFC5842
    case HTTP_IM_USED = 226; // RFC3229

    // 3XX Redirection
    case HTTP_MULTIPLE_CHOICES = 300;
    case HTTP_MOVED_PERMANENTLY = 301;
    case HTTP_FOUND = 302;
    case HTTP_SEE_OTHER = 303;
    case HTTP_NOT_MODIFIED = 304;
    case HTTP_USE_PROXY = 305;
    case HTTP_SWITCH_PROXY = 306; // Not used anymore but still reserved
    case HTTP_TEMPORARY_REDIRECT = 307;
    case HTTP_PERMANENT_REDIRECT = 308; // RFC 7538

    // 4XX Client Errors
    case HTTP_BAD_REQUEST = 400;
    case HTTP_UNAUTHORIZED = 401;
    case HTTP_PAYMENT_REQUIRED = 402;
    case HTTP_FORBIDDEN = 403;
    case HTTP_NOT_FOUND = 404;
    case HTTP_METHOD_NOT_ALLOWED = 405;
    case HTTP_NOT_ACCEPTABLE = 406;
    case HTTP_PROXY_AUTHENTICATION_REQUIRED = 407;
    case HTTP_REQUEST_TIMEOUT = 408;
    case HTTP_CONFLICT = 409;
    case HTTP_GONE = 410;
    case HTTP_LENGTH_REQUIRED = 411;
    case HTTP_PRECONDITION_FAILED = 412;
    case HTTP_REQUEST_ENTITY_TOO_LARGE = 413;
    case HTTP_REQUEST_URI_TOO_LONG = 414;
    case HTTP_UNSUPPORTED_MEDIA_TYPE = 415;
    case HTTP_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    case HTTP_EXPECTATION_FAILED = 417;
    case HTTP_I_AM_A_TEAPOT = 418; // RFC2324
    case HTTP_MISDIRECTED_REQUEST = 421; // RFC7540
    case HTTP_NON_PROCESSABLE_ENTITY = 422; // RFC4918
    case HTTP_LOCKED = 423; // RFC4918
    case HTTP_FAILED_DEPENDENCY = 424; // RFC4918
    case HTTP_UNORDERED_COLLECTION = 425; // RFC3648
    case HTTP_UPGRADE_REQUIRED = 426; // RFC2817
    case HTTP_PRECONDITION_REQUIRED = 428; // RFC6585
    case HTTP_TOO_MANY_REQUESTS = 429; // RFC6585
    case HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE = 431; // RFC6585
    case HTTP_UNAVAILABLE_FOR_LEGAL_REASONS = 451; // RFC7725

    // 5XX Server Errors
    case HTTP_INTERNAL_SERVER_ERROR = 500;
    case HTTP_NOT_IMPLEMENTED = 501;
    case HTTP_BAD_GATEWAY = 502;
    case HTTP_SERVICE_UNAVAILABLE = 503;
    case HTTP_GATEWAY_TIMEOUT = 504;
    case HTTP_VERSION_NOT_SUPPORTED = 505;
    case HTTP_VARIANT_ALSO_NEGOTIATES = 506; // RFC2295
    case HTTP_INSUFFICIENT_STORAGE = 507; // RFC4918
    case HTTP_LOOP_DETECTED = 508; // RFC5842
    case HTTP_NOT_EXTENDED = 510; // RFC2774
    case HTTP_NETWORK_AUTHENTICATION_REQUIRED = 511; // RFC6585

    public static function getAllDescriptions(): array
    {
        return [
            // 1XX Informational
            self::HTTP_CONTINUE->name => 'Continue',
            self::HTTP_SWITCHING_PROTOCOLS->name => 'Switching Protocols',
            self::HTTP_PROCESSING->name => 'Processing',

            // 2XX Success
            self::HTTP_OK->name => 'OK',
            self::HTTP_CREATED->name => 'Created',
            self::HTTP_ACCEPTED->name => 'Accepted',
            self::HTTP_NON_AUTHORITATIVE_INFORMATION->name => 'Non-Authoritative Information',
            self::HTTP_NO_CONTENT->name => 'No Content',
            self::HTTP_RESET_CONTENT->name => 'Reset Content',
            self::HTTP_PARTIAL_CONTENT->name => 'Partial Content',
            self::HTTP_MULTI_STATUS->name => 'Multi-status',
            self::HTTP_ALREADY_REPORTED->name => 'Already reported',
            self::HTTP_IM_USED->name => 'IM Used',

            // 3XX Redirection
            self::HTTP_MULTIPLE_CHOICES->name => 'Multiple Choices',
            self::HTTP_MOVED_PERMANENTLY->name => 'Moved Permanently',
            self::HTTP_FOUND->name => 'Found',
            self::HTTP_SEE_OTHER->name => 'See Other',
            self::HTTP_NOT_MODIFIED->name => 'Not Modified',
            self::HTTP_USE_PROXY->name => 'Use Proxy',
            self::HTTP_SWITCH_PROXY->name => 'Switch Proxy',
            self::HTTP_TEMPORARY_REDIRECT->name => 'Temporary Redirect',
            self::HTTP_PERMANENT_REDIRECT->name => 'Permanent Redirect',

            // 4XX Client Errors
            self::HTTP_BAD_REQUEST->name => 'Bad Request',
            self::HTTP_UNAUTHORIZED->name => 'Unauthorized',
            self::HTTP_PAYMENT_REQUIRED->name => 'Payment Required',
            self::HTTP_FORBIDDEN->name => 'Forbidden',
            self::HTTP_NOT_FOUND->name => 'Not Found',
            self::HTTP_METHOD_NOT_ALLOWED->name => 'Method Not Allowed',
            self::HTTP_NOT_ACCEPTABLE->name => 'Not Acceptable',
            self::HTTP_PROXY_AUTHENTICATION_REQUIRED->name => 'Proxy Authentication Required',
            self::HTTP_REQUEST_TIMEOUT->name => 'Request Timeout',
            self::HTTP_CONFLICT->name => 'Conflict',
            self::HTTP_GONE->name => 'Gone',
            self::HTTP_LENGTH_REQUIRED->name => 'Length Required',
            self::HTTP_PRECONDITION_FAILED->name => 'Precondition Failed',
            self::HTTP_REQUEST_ENTITY_TOO_LARGE->name => 'Request Entity Too Large',
            self::HTTP_REQUEST_URI_TOO_LONG->name => 'Request-URI Too Large',
            self::HTTP_UNSUPPORTED_MEDIA_TYPE->name => 'Unsupported Media Type',
            self::HTTP_REQUESTED_RANGE_NOT_SATISFIABLE->name => 'Requested range not satisfiable',
            self::HTTP_EXPECTATION_FAILED->name => 'Expectation Failed',
            self::HTTP_I_AM_A_TEAPOT->name => 'I\'m a teapot',
            self::HTTP_MISDIRECTED_REQUEST->name => 'Misdirected Request',
            self::HTTP_NON_PROCESSABLE_ENTITY->name => 'Unprocessable Entity',
            self::HTTP_LOCKED->name => 'Locked',
            self::HTTP_FAILED_DEPENDENCY->name => 'Failed Dependency',
            self::HTTP_UNORDERED_COLLECTION->name => 'Unordered Collection',
            self::HTTP_UPGRADE_REQUIRED->name => 'Upgrade Required',
            self::HTTP_PRECONDITION_REQUIRED->name => 'Precondition Required',
            self::HTTP_TOO_MANY_REQUESTS->name => 'Too Many Requests',
            self::HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE->name => 'Request Header Fields Too Large',
            self::HTTP_UNAVAILABLE_FOR_LEGAL_REASONS->name => 'Unavailable For Legal Reasons',

            // 5XX Server Errors
            self::HTTP_INTERNAL_SERVER_ERROR->name => 'Internal Server Error',
            self::HTTP_NOT_IMPLEMENTED->name => 'Not Implemented',
            self::HTTP_BAD_GATEWAY->name => 'Bad Gateway',
            self::HTTP_SERVICE_UNAVAILABLE->name => 'Service Unavailable',
            self::HTTP_GATEWAY_TIMEOUT->name => 'Gateway Timeout',
            self::HTTP_VERSION_NOT_SUPPORTED->name => 'HTTP Version not supported',
            self::HTTP_VARIANT_ALSO_NEGOTIATES->name => 'Variant Also Negotiates',
            self::HTTP_INSUFFICIENT_STORAGE->name => 'Insufficient Storage',
            self::HTTP_LOOP_DETECTED->name => 'Loop Detected',
            self::HTTP_NOT_EXTENDED->name => 'Not Extended',
            self::HTTP_NETWORK_AUTHENTICATION_REQUIRED->name => 'Network Authentication Required',
        ];
    }
}

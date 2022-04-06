#!/usr/bin/env php
<?php

/*
 * Copyright (c) 2016 - 2022 Itspire.
 * This software is licensed under the BSD-3-Clause license. (see LICENSE.md for full license)
 * All Right Reserved.
 */

declare(strict_types=1);

const CONSTANT_REGEX_PATTERN = "|^    case ([^ ]+) = '([^']+)';$|";
const CONSTANT_SPRINTF_PATTERN = "    case %s = '%s';\n";
const IOFILE = __DIR__ . '/../../php/Enum/MimeType.php';

$data = json_decode(file_get_contents('https://cdn.jsdelivr.net/gh/jshttp/mime-db@v1.51.0/db.json'), true);
$newMimeTypes = array_keys($data);

// load current enum
$data = file_get_contents(IOFILE);
$current = [];
$pre = '';
$post = '';

foreach (explode("\n", $data) as $line) {
    if (!preg_match(CONSTANT_REGEX_PATTERN, $line, $matches)) {
        if (!$current) {
            $pre .= $line . "\n";
        } else {
            $post .= $line . "\n";
        }
        continue;
    }
    $current[$matches[1]] = $matches[2];
}

$finalMap = $current;
foreach ($newMimeTypes as $newMimeType) {
    if (!in_array($newMimeType, $current, true)) {
        $key = strtoupper(preg_replace('/([\/+-.]+)/', '_', $newMimeType));
        $keys = array_keys($finalMap);

        // check for potential duplicates keys (happens if mime-type change is on a character in $separators)
        $count = 1;
        $keyAttempt = $key;
        while (in_array($keyAttempt, $keys, true)) {
            $keyAttempt = $key . '_' . $count;
            $count++;
        }

        $finalMap[$keyAttempt] = $newMimeType;
    }
}
ksort($finalMap);

echo "Compiling Map.\n";

$data = $pre;
foreach ($finalMap as $key => $mimeType) {
    $data .= sprintf(CONSTANT_SPRINTF_PATTERN, $key, $mimeType);
}
$data .= $post;

echo 'Writing to ' . realpath(IOFILE) . ".\n";

file_put_contents(IOFILE, rtrim($data, "\n") . "\n");

echo "Done.\n";

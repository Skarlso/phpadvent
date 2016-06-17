<?php

$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$sues = [];

foreach ($lines as $line) {
    list($_, $number, $key1, $value1, $key2, $value2, $key3, $value3) = explode(' ', $line);

    $sues[trim($number, ":")] = [trim($key1, ":") => intval(trim($value1, ",")), trime($key2, ":") => intval(trim($value2, ",")),
                         trim($key3, ":") => intval($value3)];
}

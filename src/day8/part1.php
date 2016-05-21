<?php
require "../helpers/timer.inc";

$time_start = microtime(true);

$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$total = 0;
foreach ($lines as $line) {
    $totalChar = strlen($line);
    $line = stripslashes($line);
    $line = str_replace(array('"'), '', $line);
    $memoryChar = strlen($line);
    $total += $totalChar - $memoryChar;
}

print($total . "\n");

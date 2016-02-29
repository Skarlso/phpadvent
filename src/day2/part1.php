<?php
require "../helpers/timer.inc";

$time_start = microtime(true);

$handle = @fopen("input.txt", "r");

if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
        $digits = explode("x", $buffer);
        sort($digits, SORT_NUMERIC);

    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}

<?php
require "../helpers/timer.inc";

$time_start = microtime(true);

$handle = @fopen("input.txt", "r");

function shutdown()
{
    // This is our shutdown function, in
    // here we can do any last operations
    // before the script is complete.
    global $handle, $time_start;
    if ($handle) {
        print("Closing file handler.\n");
        fclose($handle);
    }
    printf('Script executed with success:%s%s', PHP_EOL, "\n");
    DisplayElapsedTime($time_start);
}
register_shutdown_function('shutdown');

$total = 0;

if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
        $digits = explode("x", $buffer);
        $l = $digits[0];
        $w = $digits[1];
        $h = $digits[2];
        sort($digits, SORT_NUMERIC);
        $total += (2 * $l * $w) + (2 * $w * $h) + (2 * $h * $l);
        $total += ($digits[0] * $digits[1]);
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
}

printf("Total is: %d%s", $total, "\n");

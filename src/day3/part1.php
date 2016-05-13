<?php
require "../helpers/timer.inc";

$time_start = microtime(true);
$content = file_get_contents('input.txt', true);
$x = 0;
$y = 0;
$houses = [[]];

// Using something like $houses[$x . '.' . $y] here would emmit the use of the
// foreach at the end BUT!! It costs performance because it's string concatenation
// and a string as an array value. Where as scalars are faster.
// Also $houses[$x&$y] won't work because it's not unique enough.
$houses[$x][$y] = true;
foreach (str_split($content) as $c) {
    switch ($c) {
        case '^':
            $y++;
            break;
        case 'v':
            $y--;
            break;
        case '<':
            $x--;
            break;
        case '>':
            $x++;
            break;

    }
    $houses[$x][$y] = true;
}

$total = 0;
foreach ($houses as $value) {
    foreach ($value as $v) {
        $total++;
    }
}
printf("Total: %d\n", $total);
DisplayElapsedTime($time_start);

<?php
require "../helpers/timer.inc";

$time_start = microtime(true);
$content = file_get_contents('input.txt', true);
$x = 0;
$y = 0;
$houses = [[]];
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

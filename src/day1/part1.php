<?php
require "../helpers/timer.inc";
$time_start = microtime(true);

$movement = file_get_contents("input.txt");
// var_dump($movement);
// echo $movement;
$floor = 0;
$chars = str_split($movement);

for ($i=0, $_l = strlen($movement); $i < $_l; $i++) {
    $movement[$i] == ')' ? $floor-- : $floor++;
}

printf("%d\n", $floor);

DisplayElapsedTime($time_start);

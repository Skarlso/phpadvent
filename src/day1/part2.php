<?php
require "../helpers/timer.inc";
$time_start = microtime(true);

$movement = file_get_contents("input.txt");
// var_dump($movement);
// echo $movement;
$floor = 0;
$index = 0;
$basementPosition = -1;

$chars = str_split($movement);
foreach($chars as $char){
    $char == ')' ? $floor-- : $floor++;
    if ($floor == -1 && $basementPosition == -1) {
        $basementPosition = $index;
    }
    $index++;
}

printf("Floor: %d\n", $floor);
printf("Basement Position: %d\n", $basementPosition);

DisplayElapsedTime($time_start);

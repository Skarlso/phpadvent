<?php
require "../helpers/timer.inc";
//place this before any script you want to calculate time
$time_start = microtime(true);

$movement = file_get_contents("input.txt");
// var_dump($movement);
// echo $movement;
$floor = 0;
$chars = str_split($movement);
foreach($chars as $char){
    $char == ')' ? $floor-- : $floor++;
}

printf("%d\n", $floor);

DisplayElapsedTime($time_start);

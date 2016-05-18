<?php
require "../helpers/timer.inc";

$time_start = microtime(true);

$lines = file("input.txt");

foreach ($lines as $line) {
    printf("%s", $line);
}

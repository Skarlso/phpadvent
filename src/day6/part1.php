<?php
require "../helpers/timer.inc";

$time_start = microtime(true);

$grid = array_fill(0, 1000, array_fill(0, 1000, 0));

DisplayElapsedTime($time_start);

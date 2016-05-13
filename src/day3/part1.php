<?php
require "../helpers/timer.inc";

$time_start = microtime(true);
$content = file_get_contents('input.txt', true);
foreach (str_split($content) as &$c) {
    echo $c;
}

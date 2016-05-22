<?php
require "../helpers/timer.inc";

$time_start = microtime(true);

$lines = file("input.txt", FILE_IGNORE_NEW_LINES);

$locations = [];

foreach ($lines as $line) {
    $split = explode(" ", $line);
    $loc = array_key_exists($split[0], $locations) ? $locations[$split[0]] : [];
    array_push($loc, [$split[2], $split[4]]);
    $locations[$split[0]] = $loc;

    // Add the backroute as well to the same route.
    $loc2 = array_key_exists($split[2], $locations) ? $locations[$split[2]] : [];
    array_push($loc2, [$split[0], $split[4]]);
    $locations[$split[2]] = $loc2;
}

print(lookupDistance("Snowdin", "AlphaCentauri") . "\n");

function permute() {

}

function lookupDistance($from, $to) {
    global $locations;
    foreach ($locations[$from] as $v) {
        if ($v[0] == $to) {
            return $v[1];
        }
    }
}

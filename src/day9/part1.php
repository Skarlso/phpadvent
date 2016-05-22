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

$arr = [1,2,3];
print_r(permute($arr, count($arr)));

function permute(&$arr, $n) {
    if ($n == 1) {
        print_r($arr);
    } else {
        for ($i=0; $i < $n-1; $i++) {
            permute($arr, $n - 1);
            if ($n & 1 == 0) {
                $tmp = $arr[$i];
                $arr[$i] = $arr[$n-1];
                $arr[$n-1] = $tmp;
            } else {
                $tmp = $arr[0];
                $arr[0] = $arr[$n-1];
                $arr[$n-1] = $tmp;
            }
        }

        permute($arr, $n - 1);
    }
}

function lookupDistance($from, $to) {
    global $locations;
    foreach ($locations[$from] as $v) {
        if ($v[0] == $to) {
            return $v[1];
        }
    }
}

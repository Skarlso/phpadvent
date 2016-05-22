<?php
require "../helpers/timer.inc";

$time_start = microtime(true);

$lines = file("input.txt", FILE_IGNORE_NEW_LINES);

$locations = [];
$keys = [];

foreach ($lines as $line) {
    $split = explode(" ", $line);
    $loc = array_key_exists($split[0], $locations) ? $locations[$split[0]] : [];
    array_push($loc, [$split[2], $split[4]]);
    $locations[$split[0]] = $loc;

    // Add the backroute as well to the same route.
    $loc2 = array_key_exists($split[2], $locations) ? $locations[$split[2]] : [];
    array_push($loc2, [$split[0], $split[4]]);
    $locations[$split[2]] = $loc2;

    if (!in_array($split[0], $keys)) {
        array_push($keys, $split[0]);
    }
    if (!in_array($split[2], $keys)) {
        array_push($keys, $split[2]);
    }
}

$routes = [];
permute($keys, count($keys));
getMinimumDistance($routes);

function getMinimumDistance($routes) {
    $min = 1677215;
    foreach ($routes as $r) {
        $total = 0;
        for ($i = 0; $i < count($r) - 1; $i++) {
            $total += lookupDistance($r[$i], $r[$i + 1]);
        }
        if ($total < $min) {
            $min = $total;
        }
    }
    print($min . "\n");
}

function permute(&$arr, $n) {
    global $routes;
    if ($n == 1) {
        array_push($routes, $arr);
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

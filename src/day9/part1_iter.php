<?php
require "../helpers/timer.inc";

$time_start = microtime(true);

$lines = file("input.txt", FILE_IGNORE_NEW_LINES);

$locations = [[]];
$keys = [];

foreach ($lines as $line) {
    $split = explode(" ", $line);
    $locations[$split[0]][$split[2]] = $split[4];

    // Add the backroute as well to the same route.
    $locations[$split[2]][$split[0]] = $split[4];

    if (!in_array($split[0], $keys)) {
        array_push($keys, $split[0]);
    }
    if (!in_array($split[2], $keys)) {
        array_push($keys, $split[2]);
    }
}

getMinimumDistance();

function getMinimumDistance() {
    global $keys, $locations;
    $min = 1677215;
    foreach (permute($keys) as $r) {
        $total = 0;
        for ($i = 0; $i < count($r) - 1; $i++) {
            $total += $locations[$r[$i]][$r[$i + 1]];
        }
        if ($total < $min) {
            $min = $total;
        }
    }
    print($min . "\n");
}

function permute($arr) {
    $n = count($arr);
    $indices = range(0, $n-1);
    $cycles = range($n, 0, -1);
    $yield_arr = [];
    foreach (array_slice($indices, 0, $n) as $i) {
        array_push($yield_arr, $arr[$i]);
    }
    yield $yield_arr;

    while ($n) {
        $return = true;
        foreach (array_reverse(range(0, $n-1)) as $i) {
            $cycles[$i] -= 1;
            // echo "cycle[i]: ", $cycles[$i], "\n";
            if ($cycles[$i] == 0) {
                $indices = array_merge(
                    array_slice($indices, 0, $i),
                    array_slice($indices, $i+1),
                    [$indices[$i]]
                );
                $cycles[$i] = $n - $i;
            } else {
                $j = $cycles[$i];
                $_l = count($indices);
                $index = ($_l + (-$j % $_l)) % $_l;
                $tmp = $indices[$i];
                $indices[$i] = $indices[$index];
                $indices[$index] = $tmp;
                $yield_arr = [];
                foreach (array_slice($indices, 0, $n) as $y) {
                    array_push($yield_arr, $arr[$y]);
                }
                yield $yield_arr;
                $return = false;
                break;
            }
        }
        if ($return) {
            return;
        }
    }
}

DisplayElapsedTime($time_start);

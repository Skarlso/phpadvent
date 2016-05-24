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

getMaximumDistance();

function getMaximumDistance() {
    global $keys, $locations;
    $max = 0;
    foreach (permute($keys) as $r) {
        $total = 0;
        for ($i = 0; $i < count($r) - 1; $i++) {
            $total += $locations[$r[$i]][$r[$i + 1]];
        }
        if ($total >= $max) {
            $max = $total;
        }
    }
    print($max . "\n");
}

function permute(array $satck) {
    if (count($satck) < 2) {
        yield $satck;
    } else {
        foreach (permute(array_slice($satck, 1)) as $iteration) {
            foreach (range(0, count($satck) - 1) as $i) {
                yield array_merge(
                    array_slice($iteration, 0, $i),
                    [$satck[0]],
                    array_slice($iteration, $i)
                );
            }
        }
    }
}

DisplayElapsedTime($time_start);

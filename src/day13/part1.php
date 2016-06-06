<?php

require "../helpers/timer.inc";

$time_start = microtime(true);

$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$keys = [];
$seatings = [];


foreach ($lines as $line) {
    list($name, $_, $gainLose, $num, $_, $_, $_, $_, $_, $_, $nextTo) = explode(' ', $line);
    $nextTo = trim($nextTo, ".");
    if ($gainLose === "gain") {
        $seatings[$name][$nextTo] = intval($num);
    } else {
        $seatings[$name][$nextTo] = -intval($num);
    }

    if (!in_array($name, $keys)) {
        array_push($keys, $name);
    }
}

$bestHappiness = PHP_INT_MIN;
foreach (permute($keys) as $order) {
    $currentHappiness = 0;

    for ($i=0, $_l = count($order); $i < $_l; $i++) {
        $left = ($i - 1) % $_l;
        $right = ($i + 1) % $_l;

        if ($left < 0)
        {
            $left += $_l;
        }

        $currentHappiness += ($seatings[$order[$i]][$order[$left]] + $seatings[$order[$i]][$order[$right]]);
    }

    if ($currentHappiness > $bestHappiness) {
        $bestHappiness = $currentHappiness;
    }
}

echo "Best happiness: {$bestHappiness}", "\n";

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

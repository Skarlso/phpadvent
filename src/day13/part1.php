<?php

require "../helpers/timer.inc";

$time_start = microtime(true);

$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$keys = [];
$seatings = [];


foreach ($lines as $line) {
    // Could do some preg_grep magic here with matches, but splitting is faster.
    $split = explode(" ", $line);
    $gainLose = $split[2];
    $num = $split[3];
    $nextTo = trim(array_pop($split), ".");
    if ($gainLose === "gain") {
        $seatings[$split[0]][$nextTo] = intval($num);
    } else {
        $seatings[$split[0]][$nextTo] = -intval($num);
    }

    if (!in_array($split[0], $keys)) {
        array_push($keys, $split[0]);
    }
}

$bestHappiness = PHP_INT_MIN;
foreach (permute($keys) as $order) {
    $currentHappiness = 0;

    for ($i=0, $_l = count($order); $i < $_l; $i++) {
        $current = $i;
        $left = $i - 1;
        $right = ($i + 1) % $_l;

        $left = $left % $_l;
        if ($left < 0)
        {
            $left += abs($_l);
        }

        $currentHappiness += ($seatings[$order[$current]][$order[$left]] + $seatings[$order[$current]][$order[$right]]);
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

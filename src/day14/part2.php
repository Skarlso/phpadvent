<?php
require "../helpers/timer.inc";

$time_start = microtime(true);

$lines = file("input.txt", FILE_IGNORE_NEW_LINES);
$reindeers = [];

foreach ($lines as $line) {
    list($name, $_, $_, $speed, $_, $_, $runduration, $_, $_, $_, $_, $_, $_, $restduration, $_) = explode(' ', $line);
    $reindeers[$name] = ['speed' => $speed, 'rundur' => $runduration,
                         'restdur' => $restduration, 'resting' => false,
                         'currrundur' => 0, 'currrestdur' => 0, 'distance' => 0];
}
// print_r($reindeers);
// Gentelman, start your engines.
$inleadDistance = 0;
for ($i=0; $i < 2503; $i++) {

    $leaders = [reset($reindeers)];
    foreach ($reindeers as &$deer) {
        if ($deer['distance'] > $leaders[0]['distance']) {
            $leaders = [$deer];
        } elseif ($deer['distance'] == $leaders[0]['distance']) {
            array_push($leaders, $deer);
        }
    }

    foreach ($leaders as &$deer) {
        $deer['distance']++;
    }

    foreach ($reindeers as &$deer) {
        if (!$deer['resting']) {
            $deer['distance'] += $deer['speed'];
            $deer['currrundur']++;
            if ($deer['currrundur'] >= $deer['rundur']) {
                $deer['resting'] = true;
                $deer['currrundur'] = 0;
            }
        } else {
            $deer['currrestdur']++;
            if ($deer['currrestdur'] >= $deer['restdur']) {
                $deer['resting'] = false;
                $deer['currrestdur'] = 0;
            }
        }
    }
}

$mostdistancetravelled = 0;

foreach ($reindeers as $deer) {
    if ($deer['distance'] > $mostdistancetravelled) {
        $mostdistancetravelled = $deer['distance'];
    }
}

echo "And the winner is: {$mostdistancetravelled}", "\n";

DisplayElapsedTime($time_start);

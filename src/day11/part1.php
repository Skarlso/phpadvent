<?php

require "../helpers/timer.inc";
$time_start = microtime(true);

$start = "hxbxwxba";
for (;;) {
    $start = increment($start, strlen($start) - 1);
    echo $start, "\n";
}

function overlapping($pass) {
    $pattern = '/(.)\1/';
    preg_match($pattern, $pass, $matches);
    if (count($matches) > 0) {
        return true;
    }
    return false;
}

function matchCharactersNotPresent($pass) {
    $pattern = '/[i|o|l]/';
    preg_match($pattern, $pass, $matches);
    if (count($matches) > 0) {
        return false;
    }
    return true;
}

function increment($pass, $n) {
    $p = $pass[$n];
    if ($n == 0) {
        if ($p == "z") {
            $p = "a";
        } else {
            $p++;
        }
        $pass[$n] = $p;
        return $pass;
    }

    if ($p == "z") {
        $p = "a";
        $pass[$n] = $p;
        increment($pass, $n - 1);
    } else {
        $p++;
    }

    $pass[$n] = $p;
    return $pass;
}

<?php

$start = "hxbxwxba";
for (;;) {
    $start = increment($start, strlen($start) - 1);
    if (overlapping($start) && matchSequentialIncreasing($start)) {
        break;
    }
}

echo $start, "\n";

function matchSequentialIncreasing($pass) {
    for ($i=0; $i < strlen($pass) - 2; $i++) {
        $a = ord($pass[$i]);
        $b = ord($pass[$i+1]);
        $c = ord($pass[$i+2]);
        if ($a+1 == $b && $a+2 == $c) {
            return true;
        }
    }

    return false;
}

function overlapping($pass) {
    $pattern = '/(.)\1.*(.)\2/';
    preg_match($pattern, $pass, $matches);
    if (count($matches) > 0) {
        return true;
    }
    return false;
}

function increment(&$pass, $n) {
    $p = $pass[$n];
    if ($n == 0) {
        if ($p == "z") {
            $p = "a";
        } else {
            $p++;
        }
        if (in_array($p, array('i', 'o', 'l'))) {
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

    if (in_array($p, array('i', 'o', 'l'))) {
        $p++;
    }
    $pass[$n] = $p;
    return $pass;
}

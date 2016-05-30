<?php

require "../helpers/timer.inc";
$time_start = microtime(true);

$start = "hxbxwxba";



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
    $z = ord('z');
    $a = ord('a');
    //Use chr to go the other way.
    if ($n == 0) {
        $p = ord($pass[$n]);
        $p++;
        $p = $a % $z;
        //TODO: To be continued.
    }
}

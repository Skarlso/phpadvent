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

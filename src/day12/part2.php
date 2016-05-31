<?php

$content = file_get_contents("input.txt", FILE_IGNORE_NEW_LINES);

function travers($json) {
    $sum = 0;
    foreach ($json as $key => $v) {
        if (is_object($v)) {
            // Need strick mode here as it will return something like 0
            // which still counts as true.
            if (in_array('red', get_object_vars($v), true) === false) {
                $sum += travers($v);
            }
        } else if (is_array($v)) {
            $sum += travers($v);
        } else if (is_numeric($v)) {
            $sum += $v;
        }
    }
    return $sum;
}

$json = json_decode($content);
$total = travers($json, false);
echo $total, "\n";

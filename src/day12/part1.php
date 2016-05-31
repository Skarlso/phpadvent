<?php

$content = file_get_contents("input.txt", FILE_IGNORE_NEW_LINES);

function travers($json) {
    $sum = 0;
    foreach ($json as $key => $v) {
        if (is_object($v)) {
            $sum += travers($v);
        } else if (is_array($v)) {
            $sum += travers($v);
        } else if (is_numeric($v)) {
            $sum += $v;
        }
    }
    return $sum;
}

$json = json_decode($content);
$total = travers($json);
echo $total, "\n";

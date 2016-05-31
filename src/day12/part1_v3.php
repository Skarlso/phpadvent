<?php

$content = file_get_contents("input.txt", FILE_IGNORE_NEW_LINES);

function calculator($total, $value) {
    if (is_numeric($value)) {
        $total += $value;
    } elseif (is_array($value)) {
        $total = array_reduce($value, 'calculator', $total);
    }
    return $total;
}

$total = array_reduce(json_decode($content, true), 'calculator', 0);

echo $total, "\n";

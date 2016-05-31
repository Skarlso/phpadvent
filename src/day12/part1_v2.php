<?php

$content = file_get_contents("input.txt", FILE_IGNORE_NEW_LINES);

$total = 0;
function travers($item, $key) {
    global $total;
    if (is_numeric($item)) {
        $total += $item;
    }
}

$json = json_decode($content, true);
array_walk_recursive($json, 'travers');
echo $total, "\n";

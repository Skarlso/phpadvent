<?php
require "../helpers/timer.inc";

$time_start = microtime(true);

$input = "1321131112";

for ($i=0; $i < 50; $i++) {
    $count = 1;
    $newInput = "";
    for ($j=0, $_l = strlen($input); $j < $_l; $j++) {
        if ($j+1 == $_l) {
            $newInput .= $count . $input[$j];
            break;
        }

        if ($input[$j] == $input[$j+1]) {
            $count++;
        } else {
            $newInput .= $count . $input[$j];
            $count = 1;
        }
    }
    $input = $newInput;
}

printf("%s\n", strlen($input));
DisplayElapsedTime($time_start);

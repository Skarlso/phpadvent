<?php
require "../helpers/timer.inc";

$time_start = microtime(true);

$INPUT = "bgvyzdsv";

$count = 0;
while (TRUE) {
    $sec = md5($INPUT . $count);
    if (substr($sec, 0, 6) === "000000") {
        break;
    }
    $count++;
}
printf("Count: %d\n", $count);

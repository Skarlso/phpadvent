<?php

function DisplayElapsedTime($startTime) {
    $time_end = microtime(true);
    $execution_time = $time_end - $startTime;

    printf("Total Execution Time: %f\n", $execution_time);
}

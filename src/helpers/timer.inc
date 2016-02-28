<?php

function DisplayElapsedTime($startTime) {
    $time_end = microtime(true);
    $execution_time = $time_end - $startTime;

    //execution time of the script
    printf("Total Execution Time: %f\n", $execution_time);
}

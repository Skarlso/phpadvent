<?php
require "../helpers/timer.inc";

$time_start = microtime(true);

function shutdown()
{
    // This is our shutdown function, in
    // here we can do any last operations
    // before the script is complete.
    global $handle, $time_start;
    if ($handle) {
        print("Closing file handler.\n");
        fclose($handle);
    }
    printf('Script executed with success:%s%s', PHP_EOL, "\n");
    DisplayElapsedTime($time_start);
}
register_shutdown_function('shutdown');

$grid = array_fill(0, 1001, array_fill(0, 1001, 0));
$handle = @fopen("input.txt", "r");

if ($handle) {

    while (($buffer = fgets($handle, 4096)) !== false) {
        $fromX = 0;
        $fromY = 0;
        $toX = 0;
        $toY = 0;
        $value = 0;
        $toggle = FALSE;
        $split = explode(" ", $buffer);
        if ($split[0] === "toggle") {
            $numberOne = explode(",", $split[1]);
            $numberTwo = explode(",", $split[3]);
            $fromX = $numberOne[0] + 1;
            $toX = $numberTwo[0] + 1;
            $fromY = $numberOne[1] + 1;
            $toY = $numberTwo[1] + 1;
            $toggle = TRUE;
        } elseif ($split[0] === "turn") {
            $numberOne = explode(",", $split[2]);
            $numberTwo = explode(",", $split[4]);
            $fromX = $numberOne[0] + 1;
            $toX = $numberTwo[0] + 1;
            $fromY = $numberOne[1] + 1;
            $toY = $numberTwo[1] + 1;
            $value = $split[1] === "on" ? 1 : 0;
        }

        for ($x = $fromX; $x <= $toX; $x++) {
            for ($y = $fromY; $y <= $toY; $y++) {
                if ($toggle) {
                    $grid[$x][$y] = 1 ^ $grid[$x][$y];
                } else {
                    $grid[$x][$y] = $value;
                }
            }
        }
    }
}

$total = 0;
for ($x = 0; $x <= 1000; $x++) {
    for ($y = 0; $y <= 1000; $y++) {
        $total += $grid[$x][$y];
    }
}

printf("Total is: %d\n", $total);
